<?php

use App\Http\Controllers\Admin\GroupVideoController as AdminGroupVideoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureEmailIsVerified as EEIV;
use App\Http\Middleware\AdminVerfied;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.post');

    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.post');

    Route::get('forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'update'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('verify-email', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');

    Route::middleware(EEIV::class)->group(function () {
        Route::group(['prefix' => 'app'], function () {
            // Profile Management Routes
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
            Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

            // dashboard
            // user table (controller to sub,)
            // add video
            // videos ('rating, desc , title,')
            // table videos (controller 2 admin(delete, edit) , user('show,rating'))
            // check out
        });
    });
    Route::middleware(AdminVerfied::class)->group(function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/video/groups', [AdminGroupVideoController::class, 'index'])->name('admin.video.groups');
            Route::get('/video/group/create', [AdminGroupVideoController::class, 'create'])->name('admin.video.group.create');
            Route::post('/video/group', [AdminGroupVideoController::class, 'store'])->name('admin.video.group.store');
            Route::get('/video/group/{groupVideo}/edit', [AdminGroupVideoController::class, 'edit'])->name('admin.video.group.edit');
            Route::put('/video/group/{groupVideo}', [AdminGroupVideoController::class, 'update'])->name('admin.video.group.update');
            Route::put('/video/group/{groupVideo}/destroy', [AdminGroupVideoController::class, 'destroy'])->name('admin.video.group.destroy');
        });
    });
});
Route::get('/', function () {
    return view('main.index');
})->name(name: 'index');
Route::get('/tutorials', function () {
    return view('main.tutorials');
})->name('tutorials');
Route::get('/app/dash', function () {
    return view('dashboard.auth.edit-profile');
})->name('dash');
Route::get('/app/videos', function () {
    return view('dashboard.admin.video.table.video-groups-table');
})->name('videos');
