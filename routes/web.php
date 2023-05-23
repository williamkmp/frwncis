<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return redirect()->route("home");
});

Route::controller(AuthenticationController::class)
    ->prefix("auth")
    ->group(function () {
        Route::get("login", "showLogin")->name("login");
        Route::get("register", "showRegister")->name("register");

        Route::post("login", "doLogin")->name("doLogin");
        Route::post("register", "doRegister")->name("doRegister");
    });
