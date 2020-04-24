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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('/', 'HomeController@index')->name('admin');

    Route::get('/commissions/paginate', 'CommissionsController@paginate')
        ->name('commissions.paginate');

    Route::get('/departments/paginate', 'DepartmentsController@paginate')
        ->name('departments.paginate');

    Route::get('/publications/paginate', 'PublicationsController@paginate')
        ->name('publications.paginate');

    //Admin and moderator only controllers
    Route::group(['middleware' => 'can:moderate'], function(){
        Route::resource('users', 'UsersController');
        Route::resource('commissions', 'CommissionsController');
        Route::resource('departments', 'DepartmentsController');
        Route::resource('publications', 'PublicationsController');
        Route::resource('places', 'PlacesController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('internships', 'InternshipsController');
        Route::resource('qualifications', 'QualificationsController');
    });

    //for administration of college
    Route::group(['middleware' => 'can:view'], function(){

        Route::resource('users', 'UsersController')->only('index', 'show');
        Route::resource('commissions', 'CommissionsController')
            ->only('index', 'show');
        Route::resource('departments', 'DepartmentsController')
            ->only('index', 'show');
        Route::resource('publications', 'PublicationsController')
            ->only('index', 'show');
        Route::resource('places', 'PlacesController')
            ->only('index', 'show');
        Route::resource('categories', 'CategoriesController')
            ->only('index', 'show');
        Route::resource('internships', 'InternshipsController')
            ->only('index', 'show');
        Route::resource('qualifications', 'QualificationsController')
            ->only('index', 'show');
    });

    //user profile routes
    Route::group(['namespace' => 'Profile', 'prefix' => 'profile'], function(){
        //user profile page routes
        Route::get('/', 'ProfileController@index')->name('profile.show');
        Route::get('/update', 'ProfileController@edit')->name('profile.edit');
        Route::put('/update', 'ProfileController@update')->name('profile.update');

        //data CRUD routes
        Route::resource('publications', 'PublicationsController', [
            'as' => 'profile'
        ]);

        Route::resource('internships', 'InternshipsController', [
            'as' => 'profile'
        ]);

        Route::resource('qualifications', 'QualificationsController', [
            'as' => 'profile'
        ]);
    });
});
