<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;


 

Route::get('/',[ListingController::class,'index'] );
 

 



// routes: 
// index- show all listing
//show - show single list
//create - show form to create
// store - me qit new listing
//edit - edit listing
//update - update listing
//destroy - fshij

//show create form 
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');

//store listing data
Route::post('/listings',[ListingController::class,'store'] )->middleware('auth');

//edit form
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');

//  update
Route::put('/listings/{listing}',[ListingController::class,'update'])->middleware('auth');

//delete
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');

//register create form
Route::get('/register',[UserController::class,'create'])->middleware('guest');

//create new user
Route::post('/users',[UserController::class,'store']);

//logout
Route::post('/logout',[UserController::class ,'logout'])->middleware('auth');

//show logniform
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');
//login
Route::post('users/authenticate',[UserController::class ,'authenticate']);

//manage
Route::get('/listings/manage ',[ListingController::class,'manage'])->middleware('auth');


//single listing leje posht
Route::get('/listings/{listing}',[ListingController::class,'show']);

