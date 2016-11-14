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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', ['as' => 'home', 'uses' => 'UsersController@getUsersDashboard']);
    Route::get('/user/{user_id}/profil', ['as' => 'users.profile', 'uses' => 'UsersController@getProfil']);
    Route::get('/user/{user_id}/kuisioner', ['as' => 'users.kuisioner', 'uses' => 'UsersController@getKuisioner']);
    Route::post('/user/{user_id}/kuisioner', ['as' => 'users.kuisioner.store', 'uses' => 'UsersController@postKuisioner']);
    Route::get('/user/{user_id}/prediksi', ['as' => 'users.prediksi.create', 'uses' => 'UsersController@getPrediksiKelulusan']);
    Route::get('/user/{user_id}/get-hasil-prediksi', ['as' => 'users.prediksi.result', 'uses' => 'UsersController@getHasilPrediksi']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', 'AdminController@getAdminDashboard');
    Route::get('/dokumen-learning', 'AdminController@indexDokumenLearning');
    Route::get('/users', 'AdminController@indexUsers');
});