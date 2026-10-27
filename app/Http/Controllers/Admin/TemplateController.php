<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::latest()->paginate(15);

        return view('admin.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:100|alpha_dash|unique:templates,slug',
            'category' => 'required|string|max:100',
            'preview_image' => 'nullable|image|max:2048',
            'blade_path' => 'required|string|max:255',
            'config_json' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('preview_image')) {
            $validated['preview_image'] = $request->file('preview_image')->store('templates/preview', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        Template::create($validated);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template berhasil dibuat.');
    }

    public function edit(Template $template)
    {
        return view('admin.templates.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:100|alpha_dash|unique:templates,slug,'.$template->id,
            'category' => 'required|string|max:100',
            'preview_image' => 'nullable|image|max:2048',
            'blade_path' => 'required|string|max:255',
            'config_json' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('preview_image')) {
            $validated['preview_image'] = $request->file('preview_image')->store('templates/preview', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $template->update($validated);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template berhasil diperbarui.');
    }

    public function destroy(Template $template)
    {
        if ($template->invitations()->exists()) {
            return back()->with('error', 'Template tidak bisa dihapus karena masih digunakan oleh undangan.');
        }

        $template->delete();

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template berhasil dihapus.');
    }
}
