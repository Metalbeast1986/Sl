<?php


//Route::get('comments/{comment}', 'CommentController@show');

//Route::patch('/{socialFeed}/like', 'SocialFeedController@like')->name('socialFeed.like');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/', 'PostController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::resource('comments', 'CommentController');

Route::resource('locations', 'LocationController');
