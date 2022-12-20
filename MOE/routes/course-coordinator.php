<?php

use App\Http\Controllers\CourseCoordinator\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Login
Route::get    ("login", [LoginController::class, "index"])->name("course-coordinator.login");
Route::post   ("login", [LoginController::class, "login"]);

Route::group(["middleware" => ["auth:course-coordinator"]], function() {

    // Logout
    Route::get("logout", [LoginController::class, "logout"]);

    // Dashboard
    // Route::get("", [HomeController::class, "index"]);
    Route::get('', function () {
        return view('welcome');
    });

});
