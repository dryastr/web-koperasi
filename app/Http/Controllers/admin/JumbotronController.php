<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jumbotron;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JumbotronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumbotrons = Jumbotron::all();

        return view('admin.jumbotron.index', compact('jumbotrons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jumbotron.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $size = $image->getSize();
            $ext = $image->getClientOriginalExtension();

            // Store the image
            $path = $image->storeAs('public/jumbotron_images', $filename);

            // Save to database
            Jumbotron::create([
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => Storage::url($path),
                'filename' => $filename,
                'size' => $size,
                'ext' => $ext,
            ]);
        }

        return redirect()->route('jumbotron.index')->with('success', 'Hero Berhasil Dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jumbotron = Jumbotron::findOrFail($id);
        return view('admin.jumbotron.show', compact('jumbotron'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jumbotron = Jumbotron::findOrFail($id);
        return view('admin.jumbotron.edit', compact('jumbotron'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $jumbotron = Jumbotron::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($jumbotron->image_url) {
                Storage::delete(str_replace('/storage', 'public', $jumbotron->image_url));
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $size = $image->getSize();
            $ext = $image->getClientOriginalExtension();

            // Store new image
            $path = $image->storeAs('public/jumbotron_images', $filename);

            // Update database record
            $jumbotron->update([
                'image_url' => Storage::url($path),
                'filename' => $filename,
                'size' => $size,
                'ext' => $ext,
            ]);
        }

        $jumbotron->update([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('jumbotron.index')->with('success', 'Hero Berhasil Diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jumbotron = Jumbotron::findOrFail($id);

        // Delete image
        if ($jumbotron->image_url) {
            Storage::delete(str_replace('/storage', 'public', $jumbotron->image_url));
        }

        $jumbotron->delete();

        return redirect()->route('jumbotron.index')->with('success', 'Hero Berhasil Dihapus.');
    }
}
