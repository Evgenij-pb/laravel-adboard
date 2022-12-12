<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'MainController@index');
Route::get('/search', 'MainController@search')->name('search');
Route::get('/category-{id}', 'MainController@AllInCategory')->name('allInCategory');
Route::get('/category-{categoryId}/{adId}', 'MainController@showAd')->name('show');

Route::auth();

Route::get('/myaccount', 'AdController@index') ->name('userHome');
Route::post('/myaccount/ad/extend/{ad}', 'AdController@extend') ->name('AdExtend');

Route::group(['prefix'=>'myaccount'],function () {
    Route::resource('ad', AdController::class);
});

Route::get('admin', 'AdminController@index')->name('adminHome');

Route::group(['prefix'=>'admin'],function () {
    Route::resource('ad', AdminController::class);
});

Route::post('/admin/ad/approve/{ad}','AdminController@approve') ->name('AdApprove');

Route::group(['prefix'=>'admin'],function () {
    Route::resource('category', CategoryController::class);
});

