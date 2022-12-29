<?php

use App\Http\Controllers\Company\Auth\LoginController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\InternshipController;
use Illuminate\Support\Facades\Route;

// Login
Route::get    ('login', [LoginController::class, 'index'])->name('company.login');
Route::post   ('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:company']], function() {

    // Logout
    Route::post('logout', [LoginController::class, 'logout']);

    // Home
    Route::get('', [CompanyController::class, 'home']);

    Route::group(['prefix' => 'vagas'], function() {

        Route::get    ('',            [InternshipController::class, 'index']);
        Route::get    ('cadastrar',   [InternshipController::class, 'create']);
        Route::post   ('',            [InternshipController::class, 'insert']);
        Route::get    ('{id}/editar', [InternshipController::class, 'edit']);
        Route::put    ('',            [InternshipController::class, 'update']);
        Route::delete ('',            [InternshipController::class, 'delete']);

    });

});
