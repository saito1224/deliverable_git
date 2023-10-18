<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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




Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
Route::controller(PostController::class)->middleware(['auth'])->group(function () {
    Route::get('/delete1', [PostController::class, 'delete1'])->name('delete1');
    Route::get('/', [PostController::class, 'front'])->name('front');
    Route::get('/postothers', [PostController::class, 'postothers'])->name('postothers');
    Route::get('/postown', [PostController::class, 'postown'])->name('postown');
    Route::get('/posted',[PostController::class,'posted'])->name('posted');
    Route::get('/post1', [PostController::class, 'post1'])->name('post1');
    Route::get('/profilecreate', [PostController::class, 'profilecreate'])->name('profilecreate');
    Route::get('/profile1', [PostController::class, 'profile1'])->name('profile1');
    Route::get('/recordset', [PostController::class, 'recordset'])->name('recordset');
    Route::get('/today', [PostController::class, 'today'])->name('today');
    Route::get('/week', [PostController::class, 'week'])->name('week');
    Route::post('/profilestore', [PostController::class, 'profilestore'])->name('profilestore');
    Route::post('/storerecord', [PostController::class, 'storerecord'])->name('storerecord');
    Route::post('/storetoday', [PostController::class, 'storetoday'])->name('storetoday');
    Route::delete('/delete/{category}', [PostController::class, 'delete'])->name('delete');
    
    Route::get('/example',[PostController::class,'example']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
