<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showCorrectHomepage(){
        if (auth()->check()) {
            return view('homepage-feed');
        }else{
            return view('homepage');
        }
    }
    public function register(Request $request) {
        $incomingfields=$request->validate([
            'username'=>['required','min:3','max:15',Rule::unique('Users','username')],
            'email'=>['required','email',Rule::unique('Users','email')],
            'password'=>['required','min:8','confirmed']
        ]);
        $incomingfields['password']= bcrypt($incomingfields['password']);
        $user=User::create($incomingfields);
        auth()->login($user);
        return redirect('/')->with('success','thank you for creating new acount');
    }

    public function login(Request $request){
        $incomingfields=$request->validate([
            'loginusername'=>'required',
            'loginpassword'=>'required',
        ]);
        //auth() is a globlaly avaialebale method for authentation
        if (auth()->attempt(['username' => $incomingfields['loginusername'],'password'=>$incomingfields['loginpassword']])) {
            $request->session()->regenerate();//creating cookie 
            return redirect('/')->with('success','you have sucessfully loged in');
        }else{
            return redirect('/')->with('success','login failed, no such user in the database');
        }
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success','you are now sucessfully loged out');
    }
}
