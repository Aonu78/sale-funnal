<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funnel;
use App\Models\FunnelRoutingRule;
use Illuminate\Http\Request;

class FunnelRoutingRuleController extends Controller
{
    public function index(Funnel $funnel)
    {
        $rules = $funnel->routingRules()->orderByDesc('priority')->get();
        return view('admin.rules.index', compact('funnel', 'rules'));
    }

    public function create(Funnel $funnel)
    {
        return view('admin.rules.create', compact('funnel'));
    }

    public function store(Request $request, Funnel $funnel)
    {
        $data = $request->validate([
            'tag' => ['required','string','max:120'],
            'priority' => ['required','integer','min:1','max:9999'],
            'conditions_json' => ['required','string'],
            'thankyou_title' => ['nullable','string','max:255'],
            'thankyou_body' => ['nullable','string','max:5000'],
            'is_active' => ['nullable'],
        ]);

        $conditions = json_decode($data['conditions_json'], true);
        if (!is_array($conditions)) {
            return back()->withErrors(['conditions_json' => 'Conditions must be valid JSON array'])->withInput();
        }

        $funnel->routingRules()->create([
            'tag' => $data['tag'],
            'priority' => (int)$data['priority'],
            'conditions' => $conditions,
            'thankyou_title' => $data['thankyou_title'] ?? null,
            'thankyou_body' => $data['thankyou_body'] ?? null,
            'is_active' => (bool)($request->input('is_active', true)),
        ]);

        return redirect()->route('admin.funnels.rules.index', $funnel)->with('success', 'Rule created');
    }

    public function edit(Funnel $funnel, FunnelRoutingRule $rule)
    {
        abort_unless($rule->funnel_id === $funnel->id, 404);
        return view('admin.rules.edit', compact('funnel', 'rule'));
    }

    public function update(Request $request, Funnel $funnel, FunnelRoutingRule $rule)
    {
        abort_unless($rule->funnel_id === $funnel->id, 404);

        $data = $request->validate([
            'tag' => ['required','string','max:120'],
            'priority' => ['required','integer','min:1','max:9999'],
            'conditions_json' => ['required','string'],
            'thankyou_title' => ['nullable','string','max:255'],
            'thankyou_body' => ['nullable','string','max:5000'],
            'is_active' => ['nullable'],
        ]);

        $conditions = json_decode($data['conditions_json'], true);
        if (!is_array($conditions)) {
            return back()->withErrors(['conditions_json' => 'Conditions must be valid JSON array'])->withInput();
        }

        $rule->update([
            'tag' => $data['tag'],
            'priority' => (int)$data['priority'],
            'conditions' => $conditions,
            'thankyou_title' => $data['thankyou_title'] ?? null,
            'thankyou_body' => $data['thankyou_body'] ?? null,
            'is_active' => (bool)($request->input('is_active', false)),
        ]);

        return redirect()->route('admin.funnels.rules.index', $funnel)->with('success', 'Rule updated');
    }

    public function destroy(Funnel $funnel, FunnelRoutingRule $rule)
    {
        abort_unless($rule->funnel_id === $funnel->id, 404);
        $rule->delete();

        return redirect()->route('admin.funnels.rules.index', $funnel)->with('success', 'Rule deleted');
    }
}
