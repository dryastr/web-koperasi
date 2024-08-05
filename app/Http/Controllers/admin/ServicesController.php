<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function index()
    {
        $ekskulls = Service::all();
        return view('admin.services.index', compact('ekskulls'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'nullable',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $file = $request->file('icon');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        Service::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'icon' => 'storage/' . $filePath
        ]);

        return redirect()->route('services.index')->with('success', 'Services Berhasil Dibuat.');
    }

    public function edit($id)
    {
        $ekskull = Service::findOrFail($id);
        return view('admin.services.edit', compact('ekskull'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'nullable',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $ekskull = Service::findOrFail($id);

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($ekskull->icon);

            $file = $request->file('icon');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $ekskull->icon = 'storage/' . $filePath;
        }

        $ekskull->title = $request->title;
        $ekskull->desc = $request->desc;
        $ekskull->save();

        return redirect()->route('services.index')->with('success', 'Services Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $ekskull = Service::findOrFail($id);
        Storage::disk('public')->delete($ekskull->icon);
        $ekskull->delete();

        return redirect()->route('services.index')->with('success', 'Services Berhasil Dihapus.');
    }
}
