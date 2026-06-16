<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\LoginHistoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\PanitiaController as AdminPanitiaController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\EventController as MahasiswaEventController;
use App\Http\Controllers\Panitia\DashboardController as PanitiaDashboardController;
use App\Http\Controllers\Panitia\EventController as PanitiaEventController;
use App\Http\Controllers\Panitia\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $events = \App\Models\Event::upcoming()->limit(6)->get();
    $stats  = [
        'total_events'    => \App\Models\Event::count(),
        'total_mahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
        'total_pendaftar' => \App\Models\Registration::count(),
        'total_panitia'   => \App\Models\User::where('role', 'panitia')->count(),
    ];
    return view('welcome', compact('events', 'stats'));
})->name('home');

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated Routes — redirect to role dashboard after login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    return match ($user->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'panitia'  => redirect()->route('panitia.dashboard'),
        default    => redirect()->route('mahasiswa.dashboard'),
    };
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkRole:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Event CRUD
        Route::resource('events', AdminEventController::class);

        // Activity Logs
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])
            ->name('activity-logs.index');

        // Login History
        Route::get('/login-history', [LoginHistoryController::class, 'index'])
            ->name('login-history.index');

        // Manage Panitia
        Route::resource('panitia', AdminPanitiaController::class)->except(['show', 'edit', 'update']);
    });

/*
|--------------------------------------------------------------------------
| Panitia Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkRole:panitia'])
    ->prefix('panitia')
    ->name('panitia.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [PanitiaDashboardController::class, 'index'])
            ->name('dashboard');

        // Event CRUD (only owned events)
        Route::resource('events', PanitiaEventController::class);

        // Registrations management (approve/reject)
        Route::get('/registrations', [RegistrationController::class, 'index'])
            ->name('registrations.index');

        Route::patch('/registrations/{registration}/approve', [RegistrationController::class, 'approve'])
            ->name('registrations.approve');

        Route::patch('/registrations/{registration}/reject', [RegistrationController::class, 'reject'])
            ->name('registrations.reject');

        Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])
            ->name('registrations.destroy');
    });

/*
|--------------------------------------------------------------------------
| Mahasiswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkRole:mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])
            ->name('dashboard');

        // Events
        Route::get('/events', [MahasiswaEventController::class, 'index'])
            ->name('events.index');

        Route::get('/events/{event}', [MahasiswaEventController::class, 'show'])
            ->name('events.show');

        // Register to event
        Route::post('/events/register', [MahasiswaEventController::class, 'register'])
            ->name('events.register');

        // Riwayat event
        Route::get('/history', [MahasiswaEventController::class, 'history'])
            ->name('history');
    });
