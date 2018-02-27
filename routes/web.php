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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::group(['middleware' => 'admin.user', 'namespace' => 'Voyager'], function () {
        Route::post('fly-settings/update/multi', 'FlysettingController@updateMulti')
            ->name('voyager.fly-settings.multi.update');
    });
});
