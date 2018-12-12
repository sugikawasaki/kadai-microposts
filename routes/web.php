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
Route::get('/', 'MicropostsController@index');

//ユーザ登録
Route::get('signup','Auth\RegisterController@showRegistrationForm')->name('signup.get'); //->nameはこのルーティングに名前を付けている、のちのForm link_to_route()で使用する
 //showRegistarationForm の中で、views/auth/register.bladeを呼び出している
Route::post('signup','Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login','Auth\LoginController@showLoginForm')->name('login'); //LoginControllerでトレイトAuthenticatesUsers内のshowLoginFormアクションを指定return view('auth.login')
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => 'auth'], function() {                                               // このグループのルーティングは必ずログイン認証をさせる、index,showの２つのアクションのみ実装する
    Route::resource('users','UsersController' , ['only' => ['index' , 'show']]);
    Route::resource('microposts', 'MicropostsController',['only' => ['store', 'destroy']]);
    
    Route::group(['prefix' => 'users/{id}'], function () {                                        // Authでログインした人のidを含めた情報をもつ,prefixは接頭語下記の第一引数の前につく
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        
        Route::post('favorite', 'MicropostFavoriteController@store')->name('micropost.favorite');
        Route::delete('unfavorite', 'MicropostFavoriteController@destroy')->name('micropost.unfavorite');
        Route::get('favoritings', 'UsersController@favoritings')->name('users.favoritings');
    });
    

});