<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

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



Route::prefix('/dashboard')->middleware('admin')->name('admin.')->group(function(){
    Route::get('dashboard',function(){
        return view('dashboard.index');
    })->name('dashboard');
    Route::resource('profile/settings', Admin\ProfileSettingController::class)->names('profile');
});

Route::prefix('/dashboard')->middleware('admin')->name('admin.')->group(function(){
    Route::resource('permissions', Admin\PermissionController::class);

    Route::get('roles/{roleId}/delete', [Admin\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [Admin\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [Admin\RoleController::class, 'givePermissionToRole']);
    Route::resource('roles', Admin\RoleController::class);

    Route::get('users/{userId}/delete', [Admin\AdminController::class, 'destroy']);
    Route::resource('users', Admin\AdminController::class);

    Route::resource('clinic',Admin\ClinicController::class);
    Route::resource('appointment',Admin\AppointmentController::class);
    Route::resource('doctor',Admin\DoctorController::class);

});

Route::prefix('/dashboard')->middleware('admin')->name('admin.')->group(function(){
    Route::get('forgot-password', [Admin\Auth\AdminPasswordResetLinkController::class, 'create'])
        ->name('password.request')->withoutMiddleware('admin');

    Route::post('forgot-password', [Admin\Auth\AdminPasswordResetLinkController::class, 'store'])
        ->name('password.email')->withoutMiddleware('admin');

    Route::get('reset-password/{token}', [Admin\Auth\AdminNewPasswordController::class, 'create'])
        ->name('password.reset')->withoutMiddleware('admin');

    Route::post('reset-password', [Admin\Auth\AdminNewPasswordController::class, 'store'])
        ->name('password.store')->withoutMiddleware('admin');
});

require __DIR__.'/auth.php';
