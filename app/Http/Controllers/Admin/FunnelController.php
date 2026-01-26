<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funnel;
use Illuminate\Http\Request;

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

    private function uploadHeroToPublic(Request $request): ?string
    {
        if (!$request->hasFile('hero_image')) {
            return null;
        }

        $file = $request->file('hero_image');

        $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $folder = public_path('funnels');
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        // Move file to public/funnels
        $file->move($folder, $name);

        // Save relative path
        return 'funnels/' . $name;
    }

    private function deletePublicFile(?string $relativePath): void
    {
        if (!$relativePath) return;

        $full = public_path($relativePath);
        if (is_file($full)) {
            @unlink($full);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => ['required','string','max:120','unique:funnels,slug'],
            'title' => ['required','string','max:190'],
            'seo_title' => ['nullable','string','max:190'],
            'seo_description' => ['nullable','string','max:300'],
            'hero_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'footer_text' => ['nullable','string'],
            'is_active' => ['nullable','boolean'],
        ]);

        $path = $this->uploadHeroToPublic($request);

        Funnel::create([
            'slug' => $data['slug'],
            'title' => $data['title'],
            'seo_title' => $data['seo_title'] ?? null,
            'seo_description' => $data['seo_description'] ?? null,
            'hero_image_path' => $path,
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
            'hero_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'footer_text' => ['nullable','string'],
            'is_active' => ['nullable','boolean'],
        ]);

        if ($request->hasFile('hero_image')) {
            // delete old
            $this->deletePublicFile($funnel->hero_image_path);

            // upload new
            $funnel->hero_image_path = $this->uploadHeroToPublic($request);
        }

        $funnel->fill([
            'slug' => $data['slug'],
            'title' => $data['title'],
            'seo_title' => $data['seo_title'] ?? null,
            'seo_description' => $data['seo_description'] ?? null,
            'footer_text' => $data['footer_text'] ?? null,
            'is_active' => (bool)($data['is_active'] ?? false),
        ])->save();

        return redirect()->route('admin.funnels.index')->with('success', 'Funnel updated');
    }

    public function destroy(Funnel $funnel)
    {
        $this->deletePublicFile($funnel->hero_image_path);

        $funnel->delete();

        return redirect()->route('admin.funnels.index')->with('success', 'Funnel deleted');
    }
}
