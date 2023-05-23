<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function showLogin(){
        return view("login");
    }

    public function showRegister(){
        return view("register");
    }

    public function doLogin(Request $request){
        //TODO: create user logic
    }

    public function doRegister(Request $request){
        $validatedRequest = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed",
            "password_confirmation" => "required",
            "term_and_condition" => "accepted"
        ]);

        User::create([
            "name" => $validatedRequest["name"],
            "email" => $validatedRequest["email"],
            "password" => bcrypt($validatedRequest["password"]),
        ]);

        return redirect()->route("login")->with("notif", "registration successfull please login using your account.");
    }
}
