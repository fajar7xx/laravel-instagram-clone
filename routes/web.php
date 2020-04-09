<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Mail\NewUserWelcomeMail;

Auth::routes();

Route::get('email', function(){
    return new NewUserWelcomeMail();
});
// axios post method
// Route::post('follow/{user}', function(){
//     return['sukses follownya'];
// });
Route::post('follow/{user}', 'FollowsController@store');

// Route::get('p/create', 'PostsController@create');
// taruh controller resources semuanay menjadi satu disini
Route::get('/', 'HomeController@index');
Route::resources([
    'p' => 'PostsController'
]);


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

