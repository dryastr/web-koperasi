<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('admin.news.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
            // 'source' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            $validatedData['image_url'] = $imagePath;
        }

        $validatedData['filename'] = $request->file('image')->getClientOriginalName();
        $validatedData['size'] = $request->file('image')->getSize();
        $validatedData['ext'] = $request->file('image')->getClientOriginalExtension();

        News::create($validatedData);

        return redirect()->route('news.index')->with('success', 'Berita Berhasil Ditambahkan.');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.show', compact('news'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
        ]);

        $news = News::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($news->image_url) {
                Storage::disk('public')->delete($news->image_url);
            }

            $imagePath = $request->file('image')->store('news_images', 'public');
            $validatedData['image_url'] = $imagePath;

            $validatedData['filename'] = $request->file('image')->getClientOriginalName();
            $validatedData['size'] = $request->file('image')->getSize();
            $validatedData['ext'] = $request->file('image')->getClientOriginalExtension();
        } else {
            unset($validatedData['filename']);
            unset($validatedData['size']);
            unset($validatedData['ext']);
        }

        $news->update($validatedData);

        return redirect()->route('news.index')->with('success', 'Berita Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->image_url) {
            Storage::disk('public')->delete($news->image_url);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
