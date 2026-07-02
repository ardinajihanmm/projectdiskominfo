<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Dashboard
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Staff\DashboardController as StaffDashboard;

// User
use App\Http\Controllers\User\TicketController as UserTicket;
use App\Http\Controllers\User\ProfileController;

// Admin
use App\Http\Controllers\Admin\TicketController as AdminTicket;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;

// Staff
use App\Http\Controllers\Staff\TicketController as StaffTicket;
use App\Http\Controllers\Staff\CommentController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

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
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {

    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');

    Route::get('/ticket/create', [UserTicket::class, 'create'])->name('ticket.create');
    Route::post('/ticket/store', [UserTicket::class, 'store'])->name('ticket.store');

    Route::get('/ticket/history', [UserTicket::class, 'history'])->name('ticket.history');

    Route::get('/ticket/{id}', [UserTicket::class, 'detail'])->name('ticket.detail');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    Route::resource('ticket', AdminTicket::class);

    Route::resource('service', ServiceController::class);

    Route::resource('user', UserController::class);
});

/*
|--------------------------------------------------------------------------
| Staff
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:staff'])->prefix('staff')->group(function () {

    Route::get('/dashboard', [StaffDashboard::class, 'index'])->name('staff.dashboard');

    Route::resource('ticket', StaffTicket::class);

    Route::resource('comment', CommentController::class);
});