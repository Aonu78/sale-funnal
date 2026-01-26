<?php
namespace App\Http\Controllers;

use App\Models\Funnel;
use App\Models\FunnelSubmission;
use Illuminate\Http\Request;

class FunnelPublicController extends Controller
{
    public function show(string $slug)
    {
        $funnel = Funnel::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('funnels.public.show', compact('funnel'));
    }

    public function submit(Request $request, string $slug)
    {
        $funnel = Funnel::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $rules = [
            'name'  => ['required','string','max:120'],
            'email' => ['required','email','max:190'],
            'phone' => ['required','string','max:30'],
        ];

        if ($funnel->question_type === 'yes_no') {
            $rules['question_answer'] = ['nullable','in:yes,no'];
        } else {
            $rules['question_answer'] = ['nullable','string','max:255'];
        }

        $data = $request->validate($rules);

        FunnelSubmission::create([
            'funnel_id' => $funnel->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'question_answer' => $data['question_answer'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string)$request->userAgent(), 0, 1000),
        ]);

        return redirect()->route('funnels.thanks', $funnel->slug);
    }

    public function thanks(string $slug)
    {
        $funnel = Funnel::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('funnels.public.thanks', compact('funnel'));
    }
}
