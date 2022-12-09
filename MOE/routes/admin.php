<?php

use Illuminate\Support\Facades\Route;

// Login
// Route::get    ("login", [LoginController::class, "index"])->name("admin.login");
// Route::post   ("login", [LoginController::class, "login"]);

Route::group(["middleware" => ["auth:admin"]], function() {

    // Logout
    // Route::post("logout", [LoginController::class, "logout"]);

    // Dashboard
    // Route::get("", [HomeController::class, "index"]);

});
