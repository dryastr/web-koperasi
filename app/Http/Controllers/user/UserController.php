<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Jumbotron;
use App\Models\News;
use App\Models\Service;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $jumbotrons = Jumbotron::all();
        $visiMisis = VisiMisi::all();
        $news = News::orderBy('created_at', 'desc')->get();
        $ekskulls = Service::all();

        return view('home', compact('jumbotrons', 'visiMisis', 'news', 'ekskulls'));
    }

    public function allNews()
    {
        $news = News::orderBy('created_at', 'desc')->get();

        return view('web.news.all-news', compact('news'));
    }

    public function show($id)
    {
        $berita = News::findOrFail($id);

        return view('web.news.detail-news', compact('berita'));
    }

    public function storeContact(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        ContactUs::create($validatedData);

        return redirect()->back()->with('success', 'Terimakasih Telah Menghubungi Kami!');
    }
}
