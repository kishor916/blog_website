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
        $user=User::create($incomingfields);//new object of User model is created and connection to an database withthe same fields has been made in a single line opf code.
        auth()->login($user);//this is to directly login to the newly created user account
        return redirect('/')->with('success','thank you for creating new acount');
    }

    public function login(Request $request){
        $incomingfields=$request->validate([
            'loginusername'=>'required',
            'loginpassword'=>'required',
        ]);
        //auth() is a globlaly avaialebale method for authentation
        if (auth()->attempt(['username' => $incomingfields['loginusername'],'password'=>$incomingfields['loginpassword']])) {
            $request->session()->regenerate();//creating cookie, we use this cookie to track our user activity
            return redirect('/')->with('success','you have sucessfully loged in');
        }else{
            return redirect('/')->with('success','login failed, no such user in the database');
        }
    }

    public function logout(){
        auth()->logout();//this function will also distroy the session
        return redirect('/')->with('success','you are now sucessfully loged out');
    }
    public function profile(User $user){
        //type hinting is being used here again,
        //laravel will auatomatically lookup the table for us, 
        //default lookup is based on the 'id' but here we have
        //done the lookup based on the username
        return view('profile-post',['username'=>$user->username,'posts'=>$user->posts()->latest()->get(),'postCount'=>$user->posts()->count()]);
        //here $user is an instance of the User model and thats why we are being able to use post()
        //post() has been defined in the User model 
        //inside the post is where we have defined the relationship between user tabel and post table. 
    }
}
