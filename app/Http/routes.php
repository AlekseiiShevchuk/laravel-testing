<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/profile', 'HomeController@showProfile');

Route::resource('users','UserController');
Route::resource('books','BookController');

Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

/*REST API Routes start*/
Route::group(['middleware'=>'api', 'prefix'=>'api'], function (){

   Route::get('/', function (){
     return 'Welcome to Library REST API';
   });

    Route::resource('users','UserApiController');
    Route::resource('books','BookApiController');
    Route::get('books/{id}/giveback', 'BookApiController@giveback');
    Route::get('users/{userId}/addbook/{bookId}', 'UserApiController@addBookToUser');
    Route::get('users/{id}/showbooks', 'UserApiController@showBooks');

});
/*REST API Routes end*/