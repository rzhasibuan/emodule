<?php
namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return view('admin.module.index', compact('modules'));
    }

    public function create()
    {
        return view('admin.module.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'author' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $randomImageName = uniqid('module_image_', true) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('modules', $randomImageName, 'public');
            $data['image'] = $imagePath;
        } else {
            $data['image'] = null;
        }
        $data['link_video'] = json_encode($request->input('link_video', []));
        Module::create($data);
        // Set success message for SweetAlert toast
        session()->flash('success', 'Module created successfully!');
        return redirect()->route('modules.index');
    }

    public function show(Module $module)
    {
        return view('admin.module.show', compact('module'));
    }

    public function edit(Module $module)
    {
        return view('admin.module.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'author' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $randomImageName = uniqid('module_image_', true) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('modules', $randomImageName, 'public');
            $data['image'] = $imagePath;
        } else {
            $data['image'] = $module->image;
        }
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
