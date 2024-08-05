<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->get();
        $visitorCount = Cache::get('visitor_count', 0);

        return view('admin.dashboard', compact('users', 'visitorCount'));
    }
}
