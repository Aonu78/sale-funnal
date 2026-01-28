<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::orderBy('name')->paginate(25);
        return view('admin.email-templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.email-templates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'category' => ['nullable','string','max:255'],
            'subject' => ['required','string','max:255'],
            'body' => ['required','string'],
            'description' => ['nullable','string','max:1000'],
            'variables' => ['nullable','array'],
            'is_active' => ['boolean'],
        ]);

        EmailTemplate::create($data);

        return redirect()->route('admin.email-templates.index')->with('success', 'Email template created successfully');
    }

    public function show(EmailTemplate $emailTemplate)
    {
        return view('admin.email-templates.show', compact('emailTemplate'));
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        return view('admin.email-templates.edit', compact('emailTemplate'));
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'category' => ['nullable','string','max:255'],
            'subject' => ['required','string','max:255'],
            'body' => ['required','string'],
            'description' => ['nullable','string','max:1000'],
            'variables' => ['nullable','array'],
            'is_active' => ['boolean'],
        ]);

        $emailTemplate->update($data);

        return redirect()->route('admin.email-templates.index')->with('success', 'Email template updated successfully');
    }

    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
        return redirect()->route('admin.email-templates.index')->with('success', 'Email template deleted successfully');
    }
}
