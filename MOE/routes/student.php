<?php

use Illuminate\Support\Facades\Route;

// Login
// Route::get    ("login", [LoginController::class, "index"])->name("student.login");
// Route::post   ("login", [LoginController::class, "login"]);

Route::group(["middleware" => ["auth:student"]], function() {

    // Logout
    // Route::post("logout", [LoginController::class, "logout"]);

    // Dashboard
    // Route::get("", [HomeController::class, "index"]);

});
