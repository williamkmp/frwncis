<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {

    Route::get("/", function () {
        return redirect()->route("home");
    });

    Route::controller(UserController::class)->prefix("user")->group(function () {
        Route::get("login", "showLogin")->name("login");
        Route::get("register", "showRegister")->name("register");
        Route::post("login", "doLogin")->name("doLogin");
        Route::post("register", "doRegister")->name("doRegister");
    });
});


Route::middleware("auth")->group(function () {

    Route::middleware("roleIs:Admin,Member")->group(function () {
        //TODO: implement all routes

        Route::controller(HomeController::class)->prefix("app")->group(function () {
            Route::get("home", "showHome")->name("home");
            Route::get("search",  "doSearch")->name("doSearch");
        });

        Route::controller(UserController::class)->prefix("user")->group(function () {
            Route::get("logout", "doLogout")->name("doLogout");
            Route::get("profile", "showProfile")->name("profile");
        });

        Route::get("location", [LocationController::class, "showLocations"])->name("showLocations");

        Route::get("product", [ProductController::class, "showProducts"])->name("showProducts");
    });

    Route::middleware("roleIs:Admin")->group(function () {
        //TODO: implement all routes
        Route::controller(LocationController::class)->prefix("location")->group(function(){
            Route::get("add", "showAddLocation")->name("addLocation");
            Route::post("add", "doAddLocation")->name("doAddLocation");

            Route::get("edit/{location_id}", "showEditLocation")->name("editLocation");
            Route::post("edit/{location_id}", "doEditLocation")->name("doEditLocation");

            Route::get("delete/{location_id}", "doDeleteLocation")->name("doDeleteLocation");
        });

        Route::controller(ProductController::class)->prefix("product")->group(function(){
            Route::get("add", "showAddProduct")->name("addProduct");
            Route::post("add", "doAddProduct")->name("doAddProduct");

            Route::get("edit/{product_id}", "showEditProduct")->name("editProduct");
            Route::post("edit/{product_id}", "doEditProduct")->name("doEditProduct");

            Route::get("delete/{product_id}", "doDeleteProduct")->name("doDeleteProduct");
        });
    });
});
