<?php

use App\Http\Controllers\Student\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Login
Route::get    ("login", [LoginController::class, "index"])->name("student.login");
Route::post   ("login", [LoginController::class, "login"]);

Route::group(["middleware" => ["auth:student"]], function() {

    // Logout
    Route::get("logout", [LoginController::class, "logout"]);

    // Dashboard
    // Route::get("", [HomeController::class, "index"]);
    Route::get('', function () {
        return view('student.home');
    });

});
