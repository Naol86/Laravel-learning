<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    //
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // validate
        $validated = request()->validate([
            'name' => ['required', 'min:2', 'string'],
            'email' => ['required', 'email', 'string'],
            'password' => ['required', Password::min(4), 'confirmed'],
        ]);

        // create
        $user = User::create($validated);
        // login 
        Auth::login($user);
        // redirect
        return redirect('/jobs');
    }
}
