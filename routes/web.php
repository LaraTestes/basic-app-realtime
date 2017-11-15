<?php

use App\Events\MessagePosted;

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


/**
 * Auth Routes
 */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});


/**
 * Post Messages
 */
Route::post('/api/messages', function(Request $request) {

    $user = Auth::user();

    $message = $user->messages()->create([
        'message' => request()->get('message')
    ]);

    event(new MessagePosted($message, $user));

})->middleware('auth');


/**
 * Get Messages
 */
Route::get('/api/messages', function (){

    return \App\ChatMessage::all();

})->middleware('auth');
