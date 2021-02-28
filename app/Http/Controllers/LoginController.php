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
            return redirect()->route('login')->withErrors('wrong credentials');
        }
        return redirect()->route('dashboard');
    }
}
