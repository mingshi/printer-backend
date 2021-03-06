<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('login', function()
{
	$admin_id = Cookie::get('admin_id');
    $admin_username = Cookie::get('admin_username');
    $login_time = Cookie::get('login_time');
    $encrypt_key = $admin_id . $admin_username;
    $k = Cookie::get('k');
    if (!$k) {
        return Redirect::to('/login');
    }
    $key = Crypt::decrypt($k);
    if ($key != $encrypt_key) {
        return Redirect::to('/login');
    }

    if (time() - $login_time >= 86400) {
        return Redirect::to('/login');
    }
});

//验证是否为超级管理员
Route::filter('is_super_admin', function() {
    $admin_id = Cookie::get('admin_id');
    $admin = AdminORM::whereId($admin_id)->first();
    if ($admin->is_super_admin != BaseORM::ENABLE) {
        return Redirect::route('forbidden');
    }
});

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
