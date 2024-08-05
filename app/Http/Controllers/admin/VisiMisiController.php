<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visiMisis = VisiMisi::all();
        $hasVisiMisi = VisiMisi::count() > 0;

        return view('admin.visimisi.index', compact('visiMisis', 'hasVisiMisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visimisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content_visi' => 'required|string',
            'content' => 'required|array',
            // 'content.*.title' => 'required|string',
            'content.*.description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload image jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('visimisi_images', 'public');
            $validatedData['image_url'] = $imagePath;
        }

        $validatedData['content'] = json_encode($validatedData['content']);

        VisiMisi::create($validatedData);

        return redirect()->route('visimisi.index')->with('success', 'Visi Misi berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $visiMisi = VisiMisi::findOrFail($id);
        return view('admin.visimisi.edit', compact('visiMisi'));
    }


    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content_visi' => 'required|string',
            'content' => 'required|array',
            'content.*.description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $visiMisi = VisiMisi::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($visiMisi->image_url) {
                Storage::disk('public')->delete($visiMisi->image_url);
            }

            $imagePath = $request->file('image')->store('visimisi_images', 'public');
            $validatedData['image_url'] = $imagePath;
        }

        $validatedData['content'] = json_encode($validatedData['content']);

        $visiMisi->update($validatedData);

        return redirect()->route('visimisi.index')->with('success', 'Visi Misi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visiMisi = VisiMisi::findOrFail($id);

        // Delete image
        if ($visiMisi->image_url) {
            Storage::delete(str_replace('/storage', 'public', $visiMisi->image_url));
        }

        $visiMisi->delete();

        return redirect()->route('visimisi.index')->with('success', 'Visi Misi berhasil dihapus.');
    }
}
