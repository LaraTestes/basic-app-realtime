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



Route::get('/', function () {
    return view('welcome');
});



Route::post('message', function(Request $request) {

    $user = Auth::user();

    $message = $user->messages()->create([
        'message' => request()->get('message')
    ]);

    event(new MessagePosted($message, $user));

});

Route::get('testes', function (){

    return Auth::user();

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
