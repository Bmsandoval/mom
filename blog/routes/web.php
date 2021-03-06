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

// region Items Routes
Route::get('/items', 'ItemsController@index');
Route::get('/items/{item}', 'ItemsController@show');
// endregion

//region Posts Routes
#Route::group(['prefix' => 'posts'], function () {
Route::group(['prefix' => 'posts'], function () {
    $ctrl = 'PostsController@';
    $name = 'posts.';
    $can = 'can:posts.';
    // Create
    Route::get('/create', [
        'as' => $name . 'create',
        'uses' => $ctrl . 'create',
        'middleware' => [$can . 'blog'],
    ]);
    Route::post('/store', [
        'as' => $name . 'store',
        'uses' => $ctrl . 'store',
        'middleware' => [$can . 'blog'],
    ]);
    // Read
    Route::get('/stash', [
        'as' => $name . 'stash',
        'uses' => $ctrl . 'stash',
        'middleware' => [$can . 'blog'],
    ]);
    // Update
    Route::get('/edit/{post}', [
        'as' => $name . 'edit',
        'uses' => $ctrl . 'edit',
        'middleware' => [
            $can . 'blog',
            $can . 'edit,post'
        ],
    ]);
    Route::put('/update/{post}', [
        'as' => $name . 'update',
        'uses' => $ctrl . 'update',
        'middleware' => [
            $can . 'blog',
            $can . 'edit,post'
        ],
    ]);
    // (SOFT) Delete
    Route::put('/delete/{post}', [
        'as' => $name . 'hide',
        'uses' => $ctrl . 'hide',
        'middleware' => [
            $can . 'blog',
            $can . 'edit,post'
        ],
    ]);
    // (HARD) Delete
    Route::delete('/delete/{post}', [
        'as' => $name . 'remove',
        'uses' => $ctrl . 'remove',
        'middleware' => [
            $can . 'blog',
            $can . 'delete,post'
        ],
    ]);

    // Read
    Route::get('/{post}', ['as' => $name . 'show', 'uses' => $ctrl . 'show']);
    // List
    Route::get('/', ['as' => $name . 'list', 'uses' => $ctrl . 'list']);
});
//endregion

//region Users Routes
Route::get('/invite', 'UsersController@invite')->name('users.invite')->middleware('auth');
Route::post('/send', 'UsersController@send')->name('users.send')->middleware('auth');
// Create
Route::get('/create/{token}', 'UsersController@create')->name('users.create');
Route::post('/activate/{token}', 'UsersController@store')->name('users.store');
// Read
Route::get('/users/{user}', 'UsersController@show')->where('user', '[a-zA-Z0-9]+')->name('users.read')->middleware('auth');
// Update
Route::get('/users/{user}/edit', 'UsersController@edit')->where('user', '[a-zA-Z0-9]+')->name('users.edit')->middleware('auth');
Route::patch('/users/{user}/update', 'UsersController@update')->where('user', '[a-zA-Z0-9]+')->name('users.update')->middleware('auth');
// Delete
// TODO: maybe, not sure if I want this power outside direct db access
//Route::delete('/users/{id}/delete', 'UsersController@destroy')->where('id','[0-9\-]+')->name('users.delete')->middleware('auth');
// List
Route::get('/users', 'UsersController@list')->name('users.list');
//endregion

// region Auth Routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLogin']);
Route::post('dologin', ['as' => 'dologin', 'uses' => 'Auth\LoginController@doLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@doLogout']);
// endregion

// region Basic Routes
Route::view('/about', 'main.about')->name('about');
Route::view('/', 'main.cover')->name('home');
Route::view('/test', 'test')->name('test');
// endregion




