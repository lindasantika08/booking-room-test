<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\RoomsController;
use App\Http\Controllers\Admin\RoomsController as RoomsAdmin; 
use App\Http\Controllers\Admin\UsersController;


//auth
Route::get('/', function () {
    return redirect('/login');
});
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

    Route::get('/rooms', [RoomsAdmin::class, 'index'])->name('admin.rooms');
    Route::get('/users', [UsersController::class, 'index'])->name('admin.users');

    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('admin.bookings');
});

//user
Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/dashboard', [RoomsController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/rooms', [RoomsController::class, 'index'])->name('user.rooms');
    Route::get('/rooms/{id}', [RoomsController::class, 'show'])->name('user.show');
});

