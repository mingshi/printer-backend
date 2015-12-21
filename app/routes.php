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

        //admin
        Route::any('/admin/password', ['as' => 'adminPassword', 'uses' => 'AdminController@password']);
        Route::any('/admin/passwordSave', ['as' => 'adminPasswordSave', 'uses' => 'AdminController@save']);

        //模版分类
        Route::any('/templateClass/classes', ['as' => 'templateClasses', 'uses' => 'TemplateClassController@lists']);
        Route::any('/templateClass/show', ['as' => 'templateClassShow', 'uses' => 'TemplateClassController@show']);
        Route::any('/templateClass/save', ['as' => 'templateClassSave', 'uses' => 'TemplateClassController@save']);

        //banner
        Route::any('/banner/lists', ['as' => 'bannerLists', 'uses' => 'BannerController@lists']);
        Route::any('/banner/show', ['as' => 'bannerShow', 'uses' => 'BannerController@show']);
        Route::any('/banner/save', ['as' => 'bannerSave', 'uses' => 'BannerController@save']);

        //图片上传
        Route::post('/upload/image', ['as' => 'uploadImage', 'uses' => 'UploadController@index']);

        //模版
        Route::any('/template/lists', ['as' => 'templateLists', 'uses' => 'TemplateController@lists']);
        Route::any('/template/show', ['as' => 'templateShow', 'uses' => 'TemplateController@show']);
        Route::any('/template/save', ['as' => 'templateSave', 'uses' => 'TemplateController@save']);

        //相册
        Route::any('/album/lists', ['as' => 'albumLists', 'uses' => 'AlbumController@lists']);
        Route::any('/album/show', ['as' => 'albumShow', 'uses' => 'AlbumController@show']);

        //活动
        Route::any('/activity/lists', ['as' => 'activityLists', 'uses' => 'ActivityController@lists']);
        Route::any('/activity/show', ['as' => 'activityShow', 'uses' => 'ActivityController@show']);
        Route::any('/activity/save', ['as' => 'activitySave', 'uses' => 'ActivityController@save']);
    }
);

Route::group(
    array('before' => array('login', 'is_super_admin')), function() {
        Route::any('/admin/lists', ['as' => 'adminLists', 'uses' => 'AdminController@lists']);
        Route::any('/admin/show', ['as' => 'adminShow', 'uses' => 'AdminController@show']);
        Route::any('/admin/save', ['as' => 'adminSave', 'uses' => 'AdminController@save']);
    }
);
