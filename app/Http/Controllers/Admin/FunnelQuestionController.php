<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funnel;
use App\Models\FunnelQuestion;
use Illuminate\Http\Request;

class FunnelQuestionController extends Controller
{
    public function index(Funnel $funnel)
    {
        $questions = $funnel->questions()->withCount('options')->orderBy('sort_order')->get();
        return view('admin.questions.index', compact('funnel', 'questions'));
    }

    public function create(Funnel $funnel)
    {
        return view('admin.questions.create', compact('funnel'));
    }

    public function store(Request $request, Funnel $funnel)
    {
        $data = $request->validate([
            'sort_order' => ['required','integer','min:1'],
            'key' => ['nullable','string','max:80'],
            'label' => ['required','string','max:255'],
            'help_text' => ['nullable','string','max:2000'],
            'type' => ['required','in:radio,checkbox,text'],
            'is_required' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        $funnel->questions()->create([
            ...$data,
            'is_required' => (bool)($request->input('is_required', true)),
            'is_active' => (bool)($request->input('is_active', true)),
        ]);

        return redirect()->route('admin.funnels.questions.index', $funnel)->with('success', 'Question created');
    }

    public function edit(Funnel $funnel, FunnelQuestion $question)
    {
        abort_unless($question->funnel_id === $funnel->id, 404);
        $question->load('options');
        return view('admin.questions.edit', compact('funnel', 'question'));
    }

    public function update(Request $request, Funnel $funnel, FunnelQuestion $question)
    {
        abort_unless($question->funnel_id === $funnel->id, 404);

        $data = $request->validate([
            'sort_order' => ['required','integer','min:1'],
            'key' => ['nullable','string','max:80'],
            'label' => ['required','string','max:255'],
            'help_text' => ['nullable','string','max:2000'],
            'type' => ['required','in:radio,checkbox,text'],
            'is_required' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        $question->update([
            ...$data,
            'is_required' => (bool)($request->input('is_required', false)),
            'is_active' => (bool)($request->input('is_active', false)),
        ]);

        return redirect()->route('admin.funnels.questions.index', $funnel)->with('success', 'Question updated');
    }

    public function destroy(Funnel $funnel, FunnelQuestion $question)
    {
        abort_unless($question->funnel_id === $funnel->id, 404);
        $question->delete();
        return redirect()->route('admin.funnels.questions.index', $funnel)->with('success', 'Question deleted');
    }
}
