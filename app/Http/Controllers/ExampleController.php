<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homePage(){
        $myname = 'kishor shrestha';
        $phone = ['fuck','you','bitch'];
        return view('homepage',['name'=>$myname, 'age'=>22,'phone'=>$phone]);
    }
    public function aboutPage(){
        return view('single-post');
    }
}
