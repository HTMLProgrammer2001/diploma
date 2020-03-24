<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'LoginController@index')->name('login');
Route::post('/', 'LoginController@login');

Route::get('logout', 'LoginController@logout')->name('logout');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function(){
    Route::get('/', 'HomeController@index')->name('admin');

    Route::resource('/users', 'UsersController');
    Route::resource('/commissions', 'CommissionsController');
    Route::resource('/departments', 'DepartmentsController');
});
