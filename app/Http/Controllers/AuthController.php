<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{   
    public function login(Request $request) {
        $fields = $request->validate([
            "email" => "required|string|email",
            "password" => "required|string|"
        ]);

        $user = User::where("email", $fields["email"])->first();
        //!user is use to check if the email is wrong or nor exist the !hash check is to check if the password is right
        if (!$user || !Hash::check($fields["password"], $user->password)) {
            return [
                "message" => "Authentication failed"
            ];
        }

        $token = $user->createToken("test")->plainTextToken;
        return [
            "user" => $user,
            "token" => $token
        ];
    }

    public function register(Request $request) {
        $fields = $request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users,email",
            "password" => "required|string|"
        ]);

        $user = User::create([
            "name" => $fields["name"],
            "email" => $fields["email"],
            "password" => Hash::make($fields["password"]),
        ]);

        $token = $user->createToken("test")->plainTextToken;
        return [
            "user" => $user,
            "token" => $token
        ];
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return [
            "message" => "Logged out"
        ];
    }
}
