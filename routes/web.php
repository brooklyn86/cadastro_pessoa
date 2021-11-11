<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('user/edit/{id}', ['as' => 'user.edit', 'uses' => 'App\Http\Controllers\UserController@edit'])->middleware('isAdmin');
	Route::get('user/destroy/{id}', ['as' => 'user.destroy', 'uses' => 'App\Http\Controllers\UserController@destroy'])->middleware('isAdmin');
	Route::get('recupera/users', ['as' => 'recupera.user', 'uses' => 'App\Http\Controllers\UserController@getUsers'])->middleware('isAdmin');
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);

	Route::get('list/people', ['as' => 'list.people', 'uses' => 'App\Http\Controllers\PeopleController@index']);
	Route::get('edit/people/{id}', ['as' => 'edit.people', 'uses' => 'App\Http\Controllers\PeopleController@edit']);
	Route::get('destroy/people/{id}', ['as' => 'destroy.people', 'uses' => 'App\Http\Controllers\PeopleController@destroy'])->middleware('isAdmin');
	Route::get('create/people', ['as' => 'create.people', 'uses' => 'App\Http\Controllers\PeopleController@create'])->middleware('isAdmin');
	Route::get('recupera/people', ['as' => 'recupera.people', 'uses' => 'App\Http\Controllers\PeopleController@getPeoples']);
	Route::post('create/people', ['as' => 'create.people.post', 'uses' => 'App\Http\Controllers\PeopleController@store'])->middleware('isAdmin');
	Route::post('update/people', ['as' => 'update.people', 'uses' => 'App\Http\Controllers\PeopleController@update'])->middleware('isAdmin');

	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

