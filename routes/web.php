<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


Route::middleware(['auth'])->prefix('admin')->group(function(){

    Route::get('/', function() {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
});

Auth::routes();

Route::controller(HomeController::class)->group(function() {

    Route::get('/', 'index')->name('home');
    Route::get('/post/{post:slug}', 'post')->name('home.post');
    Route::get('/about', 'about')->name('home.about');
    Route::get('/contact', 'contact')->name('home.contact');
});

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

