<?php

use App\Http\Controllers\Company\Auth\LoginController;
use App\Http\Controllers\Company\Auth\RegisterController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\InternshipController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['guest']], function() {

    // Login
    Route::get    ('login', [LoginController::class, 'index'])->name('company.login');
    Route::post   ('login', [LoginController::class, 'login']);

    // Cadastro
    Route::get    ('cadastrar', [RegisterController::class, 'index']);
    Route::post   ('cadastrar', [RegisterController::class, 'register']);

});

Route::group(['middleware' => ['auth:company']], function() {

    // Logout
    Route::post('logout', [LoginController::class, 'logout']);

    // Home
    Route::get('', [CompanyController::class, 'home']);

    Route::group(['prefix' => 'vagas'], function() {

        Route::get    ('',            [InternshipController::class, 'index']);
        Route::get    ('{id}/info',   [InternshipController::class, 'info']);
        Route::get    ('cadastrar',   [InternshipController::class, 'create']);
        Route::post   ('',            [InternshipController::class, 'insert']);
        Route::get    ('{id}/editar', [InternshipController::class, 'edit']);
        Route::put    ('',            [InternshipController::class, 'update']);
        Route::delete ('',            [InternshipController::class, 'delete']);

    });

});
