<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showLogin()
    {
        return view("login");
    }

    public function showRegister()
    {
        return view("register");
    }

    public function showProfile()
    {
        return view("profile");
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

    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => 'unique:users,email,' . $userId . '|required|email',
            "image" => "required|mimes:jpg,jpeg,png|max:10240"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'update');
        }

        $user = User::find($userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            "current_password" => "required",
            "new_password" => "required|confirmed|min:8|max:8",
            "new_password_confirmation" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'password');
        }

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors("your old password is wrong", "password");
        }

        $user = User::find($userId);
        $user->password = bcrypt($request->new_password);
        $user->save();

        Auth::attempt(
            [
                "email" => $user->email,
                "password" => $request->new_password
            ],
            Auth::viaRemember()
        );

        return redirect()->intended(route("profile"))->with("msg-success", "Password Has Been Changed!");
    }
}
