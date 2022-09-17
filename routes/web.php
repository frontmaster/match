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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {

Route::get('/mypage/{id}', 'MypagesController@index')->name('mypage');
Route::get('users_delete_confirm/{id}', 'UsersController@delete_confirm')->name('users.delete_confirm');
Route::post('users_delete_confirm/{id}', 'UsersController@delete')->name('deleteUsers');
Route::get('/post_project/{id}', 'PostProjectsController@index')->name('post.project.show');
Route::post('/post_project/{id}', 'PostProjectsController@create')->name('post.project.create');
Route::get('/profile/{id}', 'ProfilesController@edit')->name('profile.edit');
Route::post('/profile/{id}', 'ProfilesController@update')->name('profile.edit');
Route::get('/projectList', 'ProjectListsController@index')->name('projectList.show');
Route::get('ajax/projectList', 'Ajax\ProjectListsController@index');
Route::get('/projectDetail/{id}', 'PostProjectsController@detail')->name('post.project.detail');
Route::post('/projectDetail/{id}', 'PostProjectsController@apply')->name('post.project.apply');
//Route::get('/like/{id}', 'PostProjectsController@like');
Route::post('/like/{id}', 'PostProjectsController@like');
Route::put('/projectDetail/{id}', 'MessagesController@send')->name('send.msg');
Route::get('/post_projectList/{id}', 'PostProjectListsController@index')->name('post.projectList.show');
Route::get('ajax/post_projectList/{id}', 'Ajax\PostProjectListsController@index');
Route::get('/post_project_edit/{id}', 'PostProjectsController@edit')->name('post.project.edit');
Route::post('/post_project_edit/{id}', 'PostProjectsController@update')->name('post.project.update');    
Route::delete('/post_project_edit/{id}', 'PostProjectsController@delete')->name('post.project.delete');
Route::get('/apply_project_list/{id}', 'ApplyProjectListsController@index')->name('apply.projectList.show');    
Route::get('ajax/apply_project_list/{id}', 'Ajax\ApplyProjectListsController@index');
Route::get('/applyProjectDetail/{id}', 'ApplyProjectsController@index')->name('apply.project.detail');
Route::post('/applyProjectDetail/{id}', 'ApplyProjectsController@send')->name('send.directMsg');


});
