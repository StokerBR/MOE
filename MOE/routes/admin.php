<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Login
Route::get    ('login', [LoginController::class, 'index'])->name('admin.login');
Route::post   ('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:admin']], function() {

    // Logout
    Route::post('logout', [LoginController::class, 'logout']);

    // Home
    Route::get('', [AdminController::class, 'home']);

});
