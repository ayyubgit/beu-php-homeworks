<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('/', 'App\Http\Controllers\MainController@view_home');

Route::prefix('auth')->middleware('guest')->group(function () {

    Route::view('login', 'auth.login');
    Route::view('register', 'auth.register');

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');

    //
});

Route::any('auth/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth')->name('auth.logout');

Route::prefix('post')->group(function () {

    Route::get('{slug}', 'App\Http\Controllers\PostController@show');
    Route::post('{post}/comment', 'App\Http\Controllers\PostController@comment')->middleware('auth');
    Route::post('{post}/comment/{comment}/reply', 'App\Http\Controllers\PostController@reply_comment')->middleware('auth');

    //
});


Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    Route::get('post/create', 'App\Http\Controllers\PostController@view_create');
    Route::post('post/create', 'App\Http\Controllers\PostController@create');

    Route::get('post/{post}/delete', 'App\Http\Controllers\PostController@delete');
    Route::get('post/{post}/edit', 'App\Http\Controllers\PostController@view_edit');
    Route::post('post/{post}/update', 'App\Http\Controllers\PostController@update');

    Route::get('/', function () {
        return view("admin.dashboard");
    })->name('dashboard');

    Route::get('/post', [PostController::class, 'indexAdmin'])->name('post');
    Route::get('/post/create', [PostController::class, 'createAdmin'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'create'])->name('post.store');
    Route::get('/post/{post:slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{post:slug}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post:slug}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'view_create'])->name('categories.create');
    Route::post('/categories/create', [CategoryController::class, 'create'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'view_edit_admin'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    //
});


Route::get('uploads/{dir}/{filename}', function ($dir, $filename) {
    $path = storage_path("app/public/$dir/" . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
