<?php

use App\Http\Controllers\CourseCoordinator\Auth\LoginController;
use App\Http\Controllers\CourseCoordinator\CourseCoordinatorController;
use App\Http\Controllers\CourseCoordinator\InternshipController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function() {

    // Login
    Route::get  ('login', [LoginController::class, 'index'])->name('course-coordinator.login');
    Route::post ('login', [LoginController::class, 'login']);

});

Route::group(['middleware' => ['auth:course-coordinator']], function() {

    // Logout
    Route::post('logout', [LoginController::class, 'logout']);

    // Home
    Route::get('', [CourseCoordinatorController::class, 'home']);

    // Vagas
    Route::group(['prefix' => 'vagas'], function() {

        Route::get  ('',              [InternshipController::class, 'index']);
        Route::get  ('{id}/info',     [InternshipController::class, 'info']);
        Route::post ('{id}/aprovar',  [InternshipController::class, 'approve']);
        Route::post ('{id}/rejeitar', [InternshipController::class, 'reject']);

    });

});
