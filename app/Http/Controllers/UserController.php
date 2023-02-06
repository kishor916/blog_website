<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request) {
        $incomingfields=$request->validate([
            'username'=>['required','min:3','max:15',Rule::unique('Users','username')],
            'email'=>['required','email',Rule::unique('Users','email')],
            'password'=>['required','min:8','confirmed']
        ]);
        $incomingfields['password']= bcrypt($incomingfields['password']);
        User::create($incomingfields);
        return view('register');
    }
}
