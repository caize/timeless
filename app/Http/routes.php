<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', ['namespace' => 'Blog', 'prefix' => 'blog', 'uses' => 'BlogController@index']);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'Blog\BlogController@index');
    Route::get('post/{slug}', 'Blog\BlogController@view');
    Route::get('tag/{tag}', 'Blog\BlogController@postListByTag');
    Route::get('category/{class}', 'Blog\BlogController@index');
});


Route::group(['middleware' => ['web'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::auth();

    Route::get('/home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::resource('admin_user', 'AdminUserController');
    Route::delete('admin/admin_user/destroyall', ['as' => 'admin.admin_user.destroy.all', 'uses' => 'AdminUserController@destroyAll']);
    Route::resource('role', 'RoleController');
    Route::delete('admin/role/destroyall', ['as' => 'admin.role.destroy.all', 'uses' => 'RoleController@destroyAll']);
    Route::get('role/{id}/permissions', ['as' => 'admin.role.permissions', 'uses' => 'RoleController@permissions']);
    Route::post('role/{id}/permissions', ['as' => 'admin.role.permissions', 'uses' => 'RoleController@storePermissions']);
    Route::resource('permission', 'PermissionController');
    Route::delete('admin/permission/destroyall', ['as' => 'admin.permission.destroy.all', 'uses' => 'PermissionController@destroyAll']);
    //Route::resource('blog', 'BlogController');

    // blog 
    Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
        
        //post
        Route::resource('post', 'PostController');
        Route::delete('admin/blog/post/destroyall', ['as' => 'admin.blog.post.destroy.all', 'uses' => 'PostController@destroyall']);
        
        //meta
        Route::resource('meta', 'MetaController');
        Route::delete('admin/blog/meta/destroyall', ['as' => 'admin.blog.meta.destroy.all', 'uses' => 'MetaController@destroyall']);

        //config
        Route::resource('config', 'ConfigController');
        Route::delete('admin/blog/config/destroyall', ['as' => 'admin.blog.config.destroy.all', 'uses' => 'ConfigController@destroyall']);
    });
});
