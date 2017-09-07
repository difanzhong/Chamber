<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/adminManagement', 'ManagementController@index');

Route::get('/adminManagement/blog/create', 'ManagementController@create_blog');
Route::post('/upload_rolling', 'ManagementController@upload_rolling');
Route::post('/upload_card' , 'ManagementController@upload_card');
Route::post('/add_card' , 'ManagementController@add_card');
Route::post('/adminManagement/blog/store' , 'ManagementController@store_blog');
Route::get('/adminManagement/blog', 'ManagementController@blog_index');
Route::get('/adminManagement/blog/update/{id}', 'ManagementController@blog_update');
Route::post('/adminManagement/blog/store/update', 'ManagementController@store_blog_updates');

Route::get('/event', 'BlogController@index');
Route::get('/event/{id}', 'BlogController@blog');

Route::get('/aboutus', 'HomeController@about');

Route::get('/adminManagement/members', 'ManagementController@allMembers');
Route::post('/adminManagement/members/confirm', 'ManagementController@confirmMember');
Route::get('/member-registration', 'MemberController@index');
Route::post('/member/store', 'MemberController@store');
