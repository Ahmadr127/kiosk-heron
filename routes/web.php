<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kiosk\CheckinController;
use App\Http\Controllers\Kiosk\DaftarController;
use App\Http\Controllers\OrganizationTypeController;
use App\Http\Controllers\OrganizationUnitController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will be
| assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('home');

// Kiosk layanan mandiri (tanpa login petugas)
Route::get('/daftar', [DaftarController::class, 'status'])->name('kiosk.daftar.status');
Route::get('/daftar/baru', [DaftarController::class, 'baru'])->name('kiosk.daftar.baru');
Route::get('/daftar/terdaftar', [DaftarController::class, 'authForm'])->name('kiosk.daftar.auth');
Route::post('/daftar/terdaftar', [DaftarController::class, 'authenticate'])->name('kiosk.daftar.authenticate');
Route::get('/checkin', [CheckinController::class, 'index'])->name('kiosk.checkin.index');
Route::post('/checkin', [CheckinController::class, 'store'])->name('kiosk.checkin.store');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');

    // User Management routes
    Route::middleware('permission:manage_users')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Audit Log routes
    Route::middleware('permission:view_activity_logs')->group(function () {
        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('activity-logs/{activityLog}', [ActivityLogController::class, 'show'])->name('activity-logs.show');
        Route::get('activity-logs/subject/{type}/{id}', [ActivityLogController::class, 'forSubject'])->name('activity-logs.subject');
    });

    // Role Management routes
    Route::middleware('permission:manage_roles')->group(function () {
        Route::resource('roles', RoleController::class);
    });

    // Permission Management routes
    Route::middleware('permission:manage_permissions')->group(function () {
        Route::resource('permissions', PermissionController::class);
    });

    // Organization Type Management routes
    Route::middleware('permission:manage_organization_types')->group(function () {
        Route::resource('organization-types', OrganizationTypeController::class);
    });

    // Organization Unit Management routes
    Route::middleware('permission:manage_organization_units')->group(function () {
        Route::resource('organization-units', OrganizationUnitController::class);

        // Member management routes
        Route::post('organization-units/{organization_unit}/members', [OrganizationUnitController::class, 'addMember'])
            ->name('organization-units.add-member');
        Route::delete('organization-units/{organization_unit}/members/{user}', [OrganizationUnitController::class, 'removeMember'])
            ->name('organization-units.remove-member');
        Route::patch('organization-units/{organization_unit}/head', [OrganizationUnitController::class, 'updateHead'])
            ->name('organization-units.update-head');
    });

});
