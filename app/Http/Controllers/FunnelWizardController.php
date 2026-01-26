<?php
namespace App\Http\Controllers;

use App\Models\Funnel;
use App\Models\FunnelSubmission;
use App\Models\FunnelSubmissionAnswer;
use App\Services\FunnelRouter;
use Illuminate\Http\Request;

class FunnelWizardController extends Controller
{
    public function landing(string $slug)
    {
        $funnel = Funnel::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('funnels.public.landing', compact('funnel'));
    }

    public function start(Request $request, string $slug)
    {
        $funnel = Funnel::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $request->session()->put("funnel_{$funnel->id}_answers", []);
        return redirect()->route('funnels.step', [$funnel->slug, 1]);
    }

    public function step(Request $request, string $slug, int $step)
    {
        $funnel = Funnel::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $questions = $funnel->questions()->where('is_active', true)->get()->values();
        
        if ($questions->isEmpty()) abort(404, 'No questions configured');

        // contact step is after questions
        $maxStep = $questions->count() + 1;

        if ($step < 1 || $step > $maxStep) abort(404);

        // last step = contact form
        if ($step === $maxStep) {
            return view('funnels.public.contact', compact('funnel', 'step', 'maxStep'));
        }

        $question = $questions[$step - 1];
        $saved = $request->session()->get("funnel_{$funnel->id}_answers", []);
        $value = $question->key ? ($saved[$question->key] ?? null) : null;

        $question->load('options');

        return view('funnels.public.step', compact('funnel','question','step','maxStep','value'));
    }

    public function saveStep(Request $request, FunnelRouter $router, string $slug, int $step)
    {
        $funnel = Funnel::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $questions = $funnel->questions()->where('is_active', true)->get()->values();
        $maxStep = $questions->count() + 1;

        if ($step < 1 || $step > $maxStep) abort(404);

        // contact step submission
        if ($step === $maxStep) {
            $data = $request->validate([
                'first_name' => ['required','string','max:120'],
                'email' => ['required','email','max:190'],
                'phone' => ['required','string','max:40'],
            ]);

            $saved = $request->session()->get("funnel_{$funnel->id}_answers", []);

            // Create submission
            $submission = FunnelSubmission::create([
                'funnel_id' => $funnel->id,
                'name' => $data['first_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'ip_address' => $request->ip(),
                'user_agent' => substr((string)$request->userAgent(), 0, 1000),
            ]);

            // Save answers
            foreach ($questions as $q) {
                if (!$q->key) continue;
                if (!array_key_exists($q->key, $saved)) continue;

                $ans = $saved[$q->key];

                FunnelSubmissionAnswer::create([
                    'funnel_submission_id' => $submission->id,
                    'funnel_question_id' => $q->id,
                    'answer_text' => is_array($ans) ? null : (string)$ans,
                    'answer_json' => is_array($ans) ? $ans : null,
                ]);
            }

            // Route tag
            $matchedRule = $router->pickTag($funnel, $saved);
            if ($matchedRule) {
                $submission->tag = $matchedRule->tag;
                $submission->tag_meta = [
                    'rule_id' => $matchedRule->id,
                    'priority' => $matchedRule->priority,
                ];
                $submission->save();

                $request->session()->put("funnel_{$funnel->id}_thankyou", [
                    'title' => $matchedRule->thankyou_title,
                    'body' => $matchedRule->thankyou_body,
                    'tag' => $matchedRule->tag,
                ]);
            } else {
                $request->session()->put("funnel_{$funnel->id}_thankyou", [
                    'title' => 'Thank you!',
                    'body' => 'We received your details. We will contact you soon.',
                    'tag' => null,
                ]);
            }

            // clear wizard answers
            $request->session()->forget("funnel_{$funnel->id}_answers");

            return redirect()->route('funnels.thanks', $funnel->slug);
        }

        // question step save
        $question = $questions[$step - 1];
        $question->load('options');

        $rules = [];
        $field = 'answer';

        if ($question->type === 'text') {
            $rules[$field] = $question->is_required
                ? ['required','string','max:255']
                : ['nullable','string','max:255'];
        } elseif ($question->type === 'checkbox') {
            $rules[$field] = $question->is_required
                ? ['required','array','min:1']
                : ['nullable','array'];
        } else { // radio
            $allowed = $question->options->where('is_active', true)->pluck('label')->values()->all();
            $rules[$field] = $question->is_required
                ? ['required','in:'.implode(',', array_map(fn($x)=>str_replace(',', ' ', $x), $allowed))]
                : ['nullable'];
        }

        $validated = $request->validate($rules);

        $saved = $request->session()->get("funnel_{$funnel->id}_answers", []);
        if ($question->key) {
            $saved[$question->key] = $validated[$field] ?? null;
            $request->session()->put("funnel_{$funnel->id}_answers", $saved);
        }

        return redirect()->route('funnels.step', [$funnel->slug, $step + 1]);
    }

    public function thanks(Request $request, string $slug)
    {
        $funnel = Funnel::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $data = $request->session()->get("funnel_{$funnel->id}_thankyou", [
            'title' => 'Thank you!',
            'body' => 'We received your request.',
            'tag' => null,
        ]);

        return view('funnels.public.thanks_dynamic', compact('funnel','data'));
    }
}
