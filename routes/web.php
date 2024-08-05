<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\JumbotronController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\admin\VisiMisiController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    }
    return redirect()->route('login');
})->name('admin.dashboard');

Auth::routes(['middleware' => ['redirectIfAuthenticated']]);
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
// Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('jumbotron', JumbotronController::class);
    Route::resource('visimisi', VisiMisiController::class);
    Route::resource('news', NewsController::class);
    Route::get('contactus', [ContactUsController::class, 'index'])->name('contactus.index');
    Route::delete('/contactus/{id}', [ContactUsController::class, 'destroy'])->name('contactus.destroy');
    Route::resource('services', ServicesController::class);
});

Route::get('/', [UserController::class, 'index'])->name('home')->middleware('track.visitor');
Route::get('/all-news', [UserController::class, 'allNews'])->name('all-news.all');
Route::get('/news-detail/{id}', [UserController::class, 'show'])->name('news-detail.show');
Route::post('/contactus/store', [UserController::class, 'storeContact'])->name('contactus.store');
