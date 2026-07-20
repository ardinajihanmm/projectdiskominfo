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
use App\Http\Controllers\User\ProfileController as UserProfileController;

// Admin
use App\Http\Controllers\Admin\TicketController as AdminTicket;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ReportController as AdminReport;

// Staff
use App\Http\Controllers\Staff\TicketController as StaffTicket;
use App\Http\Controllers\Staff\CommentController;
use App\Http\Controllers\Staff\ProfileController;

//Landing
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Landing
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('landing');
Route::get('/pelajari-lebih-lanjut', [
    LandingController::class,
    'pelajariLebihLanjut'
])->name('landing.pelajari');
/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'login']);

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'register']);

Route::post('/logout', [LoginController::class,'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard',[UserDashboard::class,'index'])
            ->name('dashboard');

        
        Route::get('/profile', [UserProfileController::class,'index'])
    ->name('profile');

Route::put('/profile', [UserProfileController::class,'update'])
    ->name('profile.update');

Route::put('/profile/password', [UserProfileController::class,'password'])
    ->name('password.update');

        Route::get('/ticket/create',[UserTicket::class,'create'])
            ->name('ticket.create');

        Route::post('/ticket/store',[UserTicket::class,'store'])
            ->name('ticket.store');

        Route::get('/ticket/history',[UserTicket::class,'history'])
            ->name('ticket.history');

        Route::get('/ticket/{id}',[UserTicket::class,'detail'])
            ->name('ticket.detail');
            
        Route::put('/notification/{notification}/read',[UserDashboard::class,'markAsRead'])
            ->name('notification.read');
        Route::post('/ticket/{ticket}/comment', [UserTicket::class, 'storeComment'])
    ->name('ticket.comment.store');
    });

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/dashboard/ticket-stats', [AdminDashboard::class, 'ticketStats'])
            ->name('dashboard.ticket-stats');

        // Ticket
        Route::resource('ticket', AdminTicket::class)
            ->names('ticket');

        Route::get('/ticket/export/pdf',
            [AdminTicket::class, 'exportPdf'])
            ->name('ticket.export.pdf');

        Route::get('/ticket/export/excel',
            [AdminTicket::class, 'exportExcel'])
            ->name('ticket.export.excel');

        Route::put('/ticket/{ticket}/assign',
            [AdminTicket::class, 'assign'])
            ->name('ticket.assign');

        // Service
        Route::resource('service', ServiceController::class)
            ->names('service');

        // User
        Route::resource('user', UserController::class)
            ->names('user');

        // Profile
        Route::get('/profile', [AdminProfileController::class, 'index'])
            ->name('profile');

        Route::put('/profile', [AdminProfileController::class, 'update'])
            ->name('profile.update');

        Route::put('/password', [AdminProfileController::class, 'password'])
            ->name('password.update');

        Route::get('/notification/{notification}', [AdminTicket::class, 'notification'])
            ->name('notification');
        // Laporan & Evaluasi
Route::get('/report', [AdminReport::class, 'index'])
    ->name('report.index');
    });

/*
|--------------------------------------------------------------------------
| STAFF
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [StaffDashboard::class, 'index'])
            ->name('dashboard');

        // Kanban
        Route::get('/kanban', [StaffDashboard::class, 'kanban'])
            ->name('kanban');

        // Update Status Ticket (letakkan di atas resource)
        Route::put('/ticket/{ticket}/status', [StaffTicket::class, 'updateStatus'])
            ->name('ticket.status');
        // Staff mengambil tiket untuk diri sendiri
        Route::post('/ticket/{ticket}/assign', [StaffTicket::class, 'assignSelf'])
            ->name('ticket.assign');

        // Ticket
        Route::resource('ticket', StaffTicket::class)
            ->names('ticket');

        // Komentar
        Route::post('/comment', [CommentController::class, 'store'])
            ->name('comment.store');

        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile');

        Route::put('/profile/update', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
            ->name('profile.password');

         Route::get('/notification/{notification}', [StaffTicket::class, 'notification'])
            ->name('notification');
    });

