<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
        return view("login");
    }

    public function showRegister()
    {
        return view("register");
    }

    public function doRegister(Request $request)
    {
        $validatedRequest = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:8|max:20",
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

    public function doLogin(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:8|max:20"
        ]);

        $rememberUser = $request->has("remember_me");

        $isAuthenticated = Auth::attempt(
            [
                "email" => $request->email,
                "password" => $request->password
            ],
            $rememberUser
        );

        if ($isAuthenticated) {
            return redirect()->route("home");
        } else {
            return redirect()->back()->withErrors(["msg" => "wrong email or password."]);
        }
    }

    public function doLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login");
    }
}
