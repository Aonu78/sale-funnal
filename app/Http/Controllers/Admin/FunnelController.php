<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FunnelController extends Controller
{
    public function index()
    {
        $funnels = Funnel::latest()->paginate(20);
        return view('admin.funnels.index', compact('funnels'));
    }

    public function create()
    {
        return view('admin.funnels.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => ['required','string','max:120','unique:funnels,slug'],
            'title' => ['required','string','max:190'],
            'seo_title' => ['nullable','string','max:190'],
            'seo_description' => ['nullable','string','max:300'],
            'hero_image' => ['nullable','image','max:2048'],
            'question_label' => ['nullable','string','max:255'],
            'question_type' => ['required','in:yes_no,text'],
            'footer_text' => ['nullable','string'],
            'is_active' => ['nullable','boolean'],
        ]);

        $path = null;
        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('funnels', 'public');
        }

        Funnel::create([
            'slug' => $data['slug'],
            'title' => $data['title'],
            'seo_title' => $data['seo_title'] ?? null,
            'seo_description' => $data['seo_description'] ?? null,
            'hero_image_path' => $path,
            'question_label' => $data['question_label'] ?? null,
            'question_type' => $data['question_type'],
            'footer_text' => $data['footer_text'] ?? null,
            'is_active' => (bool)($data['is_active'] ?? true),
        ]);

        return redirect()->route('admin.funnels.index')->with('success', 'Funnel created');
    }

    public function edit(Funnel $funnel)
    {
        return view('admin.funnels.edit', compact('funnel'));
    }

    public function update(Request $request, Funnel $funnel)
    {
        $data = $request->validate([
            'slug' => ['required','string','max:120','unique:funnels,slug,'.$funnel->id],
            'title' => ['required','string','max:190'],
            'seo_title' => ['nullable','string','max:190'],
            'seo_description' => ['nullable','string','max:300'],
            'hero_image' => ['nullable','image','max:2048'],
            'question_label' => ['nullable','string','max:255'],
            'question_type' => ['required','in:yes_no,text'],
            'footer_text' => ['nullable','string'],
            'is_active' => ['nullable','boolean'],
        ]);

        if ($request->hasFile('hero_image')) {
            if ($funnel->hero_image_path) {
                Storage::disk('public')->delete($funnel->hero_image_path);
            }
            $funnel->hero_image_path = $request->file('hero_image')->store('funnels', 'public');
        }

        $funnel->fill([
            'slug' => $data['slug'],
            'title' => $data['title'],
            'seo_title' => $data['seo_title'] ?? null,
            'seo_description' => $data['seo_description'] ?? null,
            'question_label' => $data['question_label'] ?? null,
            'question_type' => $data['question_type'],
            'footer_text' => $data['footer_text'] ?? null,
            'is_active' => (bool)($data['is_active'] ?? false),
        ])->save();

        return redirect()->route('admin.funnels.index')->with('success', 'Funnel updated');
    }

    public function destroy(Funnel $funnel)
    {
        if ($funnel->hero_image_path) {
            Storage::disk('public')->delete($funnel->hero_image_path);
        }
        $funnel->delete();

        return redirect()->route('admin.funnels.index')->with('success', 'Funnel deleted');
    }
}
