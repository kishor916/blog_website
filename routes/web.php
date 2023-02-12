<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//user realted routs
Route::get('/',[UserController::class, "showCorrectHomepage"])->name('login');
Route::post('/register',[UserController::class, "register"])->middleware('guest');
Route::post('/login',[UserController::class, "login"])->middleware('guest');
Route::post('/logout',[UserController::class, "logout"])->middleware('loginCheck');


//blog post related routes
Route::get('/create-post',[PostController::class, "showCreateForm"])->middleware('loginCheck');
Route::post('/create-post',[PostController::class, "storeNewPost"])->middleware('loginCheck');
Route::get('/post/{post}',[PostController::class, "showSinglePost"]);

//profile related routes
Route::get('/profile/{pizza:username}',[UserController::class,'profile']);