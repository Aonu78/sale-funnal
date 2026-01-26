<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FunnelQuestion;
use App\Models\FunnelQuestionOption;
use Illuminate\Http\Request;

class FunnelQuestionOptionController extends Controller
{
    public function index(FunnelQuestion $question)
    {
        $question->load('funnel');
        $options = $question->options()->orderBy('sort_order')->get();

        return view('admin.options.index', compact('question', 'options'));
    }

    public function store(Request $request, FunnelQuestion $question)
    {
        $data = $request->validate([
            'sort_order' => ['required','integer','min:1'],
            'label' => ['required','string','max:255'],
            'value' => ['nullable','string','max:255'],
            'is_active' => ['nullable'],
        ]);

        $question->options()->create([
            ...$data,
            'is_active' => (bool)($request->input('is_active', true)),
        ]);

        return redirect()->route('admin.questions.options.index', $question)->with('success', 'Option added');
    }

    public function update(Request $request, FunnelQuestion $question, FunnelQuestionOption $option)
    {
        abort_unless($option->funnel_question_id === $question->id, 404);

        $data = $request->validate([
            'sort_order' => ['required','integer','min:1'],
            'label' => ['required','string','max:255'],
            'value' => ['nullable','string','max:255'],
            'is_active' => ['nullable'],
        ]);

        $option->update([
            ...$data,
            'is_active' => (bool)($request->input('is_active', false)),
        ]);

        return redirect()->route('admin.questions.options.index', $question)->with('success', 'Option updated');
    }

    public function destroy(FunnelQuestion $question, FunnelQuestionOption $option)
    {
        abort_unless($option->funnel_question_id === $question->id, 404);
        $option->delete();

        return redirect()->route('admin.questions.options.index', $question)->with('success', 'Option deleted');
    }
}
