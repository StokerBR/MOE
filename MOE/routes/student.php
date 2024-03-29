<?php

use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Student\Auth\RegisterController;
use App\Http\Controllers\Student\InternshipController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function() {

    // Login
    Route::get  ('login', [LoginController::class, 'index'])->name('student.login');
    Route::post ('login', [LoginController::class, 'login']);

    // Cadastro
    /* Route::get    ('cadastrar', [RegisterController::class, 'index']);
    Route::post   ('cadastrar', [RegisterController::class, 'register']); */

});

Route::group(['middleware' => ['auth:student']], function() {

    // Logout
    Route::post('logout', [LoginController::class, 'logout']);

    // Home
    Route::get('', [StudentController::class, 'home']);

    // Vagas
    Route::group(['prefix' => 'vagas'], function() {

        Route::get  ('',              [InternshipController::class, 'index']);
        Route::get  ('{id}/info',     [InternshipController::class, 'info']);

    });

});
