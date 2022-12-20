<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Login
Route::get    ("login", [LoginController::class, "index"])->name("admin.login");
Route::post   ("login", [LoginController::class, "login"]);

Route::group(["middleware" => ["auth:admin"]], function() {

    // Logout
    Route::get("logout", [LoginController::class, "logout"]);

    // Dashboard
    // Route::get("", [HomeController::class, "index"]);
    Route::get('', function () {
        return view('welcome');
    });

});
