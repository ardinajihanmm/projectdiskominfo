<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TicketController;

Route::get('/', function () {
    return view('landing.index');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
*/

Route::prefix('user')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile', [ProfileController::class, 'update']);

    Route::get('/ticket', [TicketController::class, 'index']);
    Route::get('/ticket/create', [TicketController::class, 'create']);
    Route::post('/ticket/store', [TicketController::class, 'store']);
    Route::get('/ticket/{id}', [TicketController::class, 'show']);

});