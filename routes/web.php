<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/election', function () {
    return Inertia::render('Election');
})->name('election');

Route::middleware(['auth:sanctum', 'verified'])->get('/poll', function () {
    return Inertia::render('Poll');
})->name('poll');

Route::middleware(['auth:sanctum', 'verified'])->get('/result', function () {
    return Inertia::render('Result');
})->name('result');

Route::middleware(['auth:sanctum', 'verified'])->get('/member', function () {
    return Inertia::render('Member');
})->name('member');

Route::middleware(['auth:sanctum', 'verified'])->get('/control', function () {
    return Inertia::render('Control');
})->name('control');

//Route::middleware(['auth:sanctum', 'verified'])->get('/vote', function () {
//    return Inertia::render('Dashboard');
//})->name('vote');

Route::resource('posts',  PostController::class);
