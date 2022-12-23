<?php

use App\Http\Controllers\CourseCoordinator\Auth\LoginController;
use App\Http\Controllers\CourseCoordinator\CourseCoordinatorController;
use Illuminate\Support\Facades\Route;

// Login
Route::get    ('login', [LoginController::class, 'index'])->name('course-coordinator.login');
Route::post   ('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:course-coordinator']], function() {

    // Logout
    Route::post('logout', [LoginController::class, 'logout']);

    // Home
    Route::get('', [CourseCoordinatorController::class, 'home']);

});
