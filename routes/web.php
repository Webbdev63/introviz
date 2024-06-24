<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OutOfService;
use App\Http\Controllers\SquareUpPaymentGateway;
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
 Route::post('Insurance-file-search', [OutOfService::class, 'outOfServiceSearch'])->name('outOfServiceSearch');
 Route::get('InsuranceFile', [HomeController::class, 'InsuranceFile'])->name('InsuranceFile');
 Route::post('process-payment', [HomeController::class, 'processPayment'])->name('processPayment');
 Route::get('pay',  [SquareUpPaymentGateway::class, 'cardPayment'])->name('card-payment');
 Route::post('/makePayment', [SquareUpPaymentGateway::class, 'makePayment'])->name('makePayment');


//  Route::get('/dashboard', function () {
//      return view('home');
//  })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/about', [ProfileController::class, 'index']);
Route::get('/exportToExcel/{id}', [HomeController::class, 'exportToExcel'])->name('exportToExcel');
Route::get('/exportServiceFile/{id}', [OutOfService::class, 'exportServiceFile'])->name('exportServiceFile');
Route::get('/saved-Insurance-record', [OutOfService::class, 'savedOutofService'])->name('savedOutofService');

Route::middleware('auth')->group(function () {
	    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
