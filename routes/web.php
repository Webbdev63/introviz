<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OutOfService;
// Route::get('/', function () {
//     return view('welcome');
// });

 Route::get('/home', [HomeController::class, 'home'])->name('home');
 Route::get('/', [HomeController::class, 'home'])->name('home');
 Route::post('/get-cities', [HomeController::class, 'getCities'])->name('getCities');
 Route::get('/checkoutpage', [HomeController::class, 'checkoutpage'])->name('checkoutpage');
 Route::post('/search', [HomeController::class, 'search'])->name('search');
 Route::get('/saved-order', [HomeController::class, 'savedOrder'])->name('savedOrder');
 Route::get('Outofservicefile', [HomeController::class, 'Outofservicefile'])->name('Outofservicefile');
 Route::post('out-of-service-file-search', [OutOfService::class, 'outOfServiceSearch'])->name('outOfServiceSearch');
 Route::get('InsuranceFile', [HomeController::class, 'InsuranceFile'])->name('InsuranceFile');

 Route::get('/dashboard', function () {
     return view('dashboard');
 })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about', [ProfileController::class, 'index']);
Route::get('/exportToExcel/{id}', [HomeController::class, 'exportToExcel'])->name('exportToExcel');
Route::get('/export-outof-serviceFile/{id}', [OutOfService::class, 'exportServiceFile'])->name('exportServiceFile');
Route::get('/saved-Out-of-Service', [OutOfService::class, 'savedOutofService'])->name('savedOutofService');

Route::middleware('auth')->group(function () {
	    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';