<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {

    Route::get("/", function () {
        return redirect()->route("home");
    });

    Route::controller(AuthenticationController::class)->prefix("auth")->group(function () {
        Route::get("login", "showLogin")->name("login");
        Route::get("register", "showRegister")->name("register");
        Route::post("login", "doLogin")->name("doLogin");
        Route::post("register", "doRegister")->name("doRegister");
    });
});


Route::middleware("auth")->group(function () {

    Route::middleware("roleIs:Admin,Member")->group(function(){
        //TODO: implement all routes
        Route::get("/home", [HomeController::class, "showHome"])->name("home");
        Route::get("/dump", [HomeController::class, "showDump"])->name("dump");
        Route::get("/search", [HomeController::class, "doSearch"])->name("doSearch");
        Route::get("/doLogout", [AuthenticationController::class, "doLogout"])->name("doLogout");

    });

    Route::middleware("roleIs:Admin")->group(function(){
        //TODO: implement all routes
    });
});
