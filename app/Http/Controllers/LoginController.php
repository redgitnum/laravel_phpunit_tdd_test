<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('login')->withErrors('Wrong credentials');
        }
        return redirect()->route('dashboard');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully');
    }
}
