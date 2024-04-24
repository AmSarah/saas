<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Feature1Controller;
use App\Http\Controllers\Feature2Controller;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/feature1', [Feature1Controller::class, 'index'])->middleware(['auth', 'verified'])->name('feature1.index');
Route::post('/feature1/calculate',[Feature1Controller::class, 'calculate'])->middleware(['auth', 'verified'])->name('feature1.calculate');
Route::get('/feature2', [Feature2Controller::class, 'index'])->middleware(['auth', 'verified'])->name('feature2.index');
Route::post('/feature2/calculate',[Feature2Controller::class, 'calculate'])->middleware(['auth', 'verified'])->name('feature2.calculate');

Route::post('/buy-credits/webhook', [CreditController::class, 'webhook'])->name('credit.webhook');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/buy-credits', [CreditController::class, 'index'])->name('credit.index');
    Route::get('/buy-credits/suucess', [CreditController::class, 'success'])->name('credit.success');
    Route::get('/buy-credits/cancel', [CreditController::class, 'cancel'])->name('credit.cancel');
    Route::post('/buy-credits/{package}', [CreditController::class, 'buyCredits'])->name('credit.buy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
