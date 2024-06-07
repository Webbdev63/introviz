<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
// Route::get('/', function () {
//     return view('welcome');
// });

 Route::get('/home', [HomeController::class, 'home'])->name('home');
 Route::get('/', [HomeController::class, 'home'])->name('home');
 Route::post('/get-cities', [HomeController::class, 'getCities'])->name('getCities');
 Route::get('/checkoutpage', [HomeController::class, 'checkoutpage'])->name('checkoutpage');
 Route::post('/search', [HomeController::class, 'search'])->name('search');
 Route::get('/saved-order', [HomeController::class, 'savedOrder'])->name('savedOrder');

 Route::get('/dashboard', function () {
     return view('dashboard');
 })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about', [ProfileController::class, 'index']);

Route::middleware('auth')->group(function () {
	    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
