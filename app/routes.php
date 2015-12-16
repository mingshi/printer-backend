<?php
//登录入口和过滤器
Route::get('/', ['as' => 'home', 'uses' => 'EntryController@home']);
Route::get('/login', ['as' => 'login', 'uses' => 'EntryController@login']);
Route::post('/dologin', ['as' => 'dologin', 'uses' => 'EntryController@dologin']);
Route::any('/logout', ['as' => 'logout', 'uses' => 'EntryController@logout']);
Route::get('/403', ['as' => 'forbidden', 'uses' => 'ForbiddenController@index']);
Route::get('/captcha', ['as' => 'captcha', 'uses' => 'EntryController@captcha']);

Route::group(
	array('before' => array('login')), function () {
		//用户列表
        Route::any('/user/lists', ['as' => 'userLists', 'uses' => 'UserController@lists']);
        Route::any('/user/show', ['as' => 'userShow', 'uses' => 'UserController@show']);
        Route::any('/user/save', ['as' => 'userSave', 'uses' => 'UserController@save']);
	}
);
