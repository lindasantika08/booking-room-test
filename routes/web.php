<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

//admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('auth')->name('dashboard');

    Route::get('/rooms', function () {
        return view('admin.rooms');
    })->name('admin.rooms');

    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('admin.bookings');
});

//user
Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->middleware('auth')->name('dashboard');

    Route::get('/rooms', function () {
        return view('user.rooms');
    })->name('user.rooms');

    Route::get('/bookings', function () {
        return view('user.bookings');
    })->name('user.bookings');
});

