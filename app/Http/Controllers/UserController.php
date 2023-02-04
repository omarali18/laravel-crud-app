<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request){
        $loginField = $request->validate([
            'loginname' => "required",
            'loginpassword' => 'required'
        ]);
        if(auth()->attempt([ "name" => $loginField["loginname"], "password" => $loginField["loginpassword" ]])){
            $request->session()->regenerate();
        };
        return redirect("/");
    }

    public function logout(){
        auth()->logout();
        return redirect("/");
    }

    public function registation(Request $request)
    {
        $registerField = $request->validate([
            "name" => ["required", "min:3", "max:20", Rule::unique("users", "name")],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "password" => ["required", "min:4", "max:12"]
        ]);
        // dd($registerField);

        $registerField["password"] = Hash::make($registerField["password"]);
        $user = User::create($registerField);
        auth()->login($user);
        return redirect('/');
    }
}
