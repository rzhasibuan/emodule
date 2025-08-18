<?php
namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return view('admin.modules', compact('modules'));
    }

    public function create()
    {
        return view('admin.createmodule');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf',
            'link_quiz' => 'nullable|array',
            'link_video' => 'nullable|array',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $randomName = uniqid('module_', true) . '.pdf';
            $path = $file->storeAs('modules', $randomName, 'public');
            $data['file'] = $path;
        } else {
            $data['file'] = null;
        }
        $data['link_quiz'] = json_encode($request->input('link_quiz', []));
        $data['link_video'] = json_encode($request->input('link_video', []));
        Module::create($data);
        // Set success message for SweetAlert toast
        session()->flash('success', 'Module created successfully!');
        return redirect()->route('modules.index');
    }

    public function show(Module $module)
    {
        return view('admin.showmodule', compact('module'));
    }

    public function edit(Module $module)
    {
        return view('admin.editmodule', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf',
            'link_quiz' => 'nullable|array',
            'link_video' => 'nullable|array',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $randomName = uniqid('module_', true) . '.pdf';
            $path = $file->storeAs('modules', $randomName, 'public');
            $data['file'] = $path;
        } else {
            $data['file'] = $module->file;
        }
        $data['link_quiz'] = json_encode($request->input('link_quiz', []));
        $data['link_video'] = json_encode($request->input('link_video', []));
        $module->update($data);
        // Set success message for SweetAlert toast
        session()->flash('success', 'Module updated successfully!');
        return redirect()->route('modules.index');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        // Set success message for SweetAlert toast
        session()->flash('success', 'Module deleted successfully!');
        return redirect()->route('modules.index');
    }
}
