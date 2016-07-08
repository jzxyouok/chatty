<?php

/* Home Route */
Route::get('/', [
    'uses' => '\Chatty\Http\Controllers\HomeController@index',
    'as' => 'home'
]);

/* Authentication Routes */
Route::get('/signup', [
    'uses' => '\Chatty\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup',
    'middleware' => ['guest'],
]);

Route::post('/signup', [
    'uses' => '\Chatty\Http\Controllers\AuthController@postSignup',
    'middleware' => ['guest'],
]);

Route::get('/signin', [
    'uses' => '\Chatty\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin',
    'middleware' => ['guest'],
]);

Route::post('/signin', [
    'uses' => '\Chatty\Http\Controllers\AuthController@postSignin',
    'middleware' => ['guest'],
]);

Route::get('/signout', [
    'uses' => '\Chatty\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout',
]);

/* Results */
Route::get('/search', [
    'uses' => '\Chatty\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
    'middleware' => ['auth'],
]);

/* Profile route */
Route::get('/user/{username}',[
    'uses' => '\Chatty\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
    'middleware' => ['auth'],
]);

Route::get('/profile/edit',[
    'uses' => '\Chatty\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth'],
]);

Route::post('/profile/edit',[
    'uses' => '\Chatty\Http\Controllers\ProfileController@postEdit',
    'middleware' => ['auth'],
]);

Route::post('/profile/edit/upload',[
    'uses' => '\Chatty\Http\Controllers\ProfileController@uploadPicture',
    'as' => 'upload.dp',
    'middleware' => ['auth'],
]);

/* Image route */
Route::get('/user/images/{filename}', [
    'uses' => '\Chatty\Http\Controllers\ProfileController@displayPicture',
    'as' => 'display.dp',
    'middleware' => ['auth'],
]);

/* Friends */
Route::get('/friends',[
    'uses' => '\Chatty\Http\Controllers\FriendController@getIndex',
    'as' => 'profile.friend',
    'middleware' => ['auth'],
]);

Route::get('/friends/add/{username}',[
    'uses' => '\Chatty\Http\Controllers\FriendController@getAdd',
    'as' => 'friend.add',
    'middleware' => ['auth'],
]);

Route::get('/friends/accept/{usename}',[
    'uses' => '\Chatty\Http\Controllers\FriendController@getAccept',
    'as' => 'friend.accept',
    'middleware' => ['auth'],
]);

/* Stautuses */
Route::post('/status',[
    'uses' => '\Chatty\Http\Controllers\StatusController@postStatus',
    'as' => 'status.post',
    'middleware' => ['auth'],
]);

Route::post('/status/{statusId}/reply',[
    'uses' => '\Chatty\Http\Controllers\StatusController@postReply',
    'as' => 'status.reply',
    'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/delete' ,[
    'uses' => '\Chatty\Http\Controllers\StatusController@deleteReply',
    'as' => 'status.delete',
    'middleware' => 'auth'
]);

Route::get('/status/{statusId}/edit' ,[
    'uses' => '\Chatty\Http\Controllers\StatusController@editReply',
    'as' => 'status.edit',
    'middleware' => 'auth'
]);

Route::post('/status/{statusId}/edit' ,[
    'uses' => '\Chatty\Http\Controllers\StatusController@postEditReply',
    'middleware' => 'auth'
]);

/* Like route */
Route::get('status/{statusId}/like', [
    'uses' => '\Chatty\Http\Controllers\StatusController@getLike',
    'as' => 'status.like',
    'middleware' => 'auth'
]);

Route::get('status/{statusId}/dislike', [
    'uses' => '\Chatty\Http\Controllers\StatusController@getDislike',
    'as' => 'status.dislike',
    'middleware' => 'auth'
]);