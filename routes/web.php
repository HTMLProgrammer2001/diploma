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

    //paginators
    Route::group(['middleware' => 'can:view'], function() {
        Route::post('/commissions/paginate', 'CommissionsController@paginate')
            ->name('commissions.paginate');

        Route::post('/departments/paginate', 'DepartmentsController@paginate')
            ->name('departments.paginate');

        Route::post('/publications/paginate', 'PublicationsController@paginate')
            ->name('publications.paginate');

        Route::post('/users/paginate', 'UsersController@paginate')
            ->name('users.paginate');

        Route::post('/categories/paginate', 'CategoriesController@paginate')
            ->name('categories.paginate');

        Route::post('/internships/paginate', 'InternshipsController@paginate')
            ->name('internships.paginate');

        Route::post('/qualifications/paginate', 'QualificationsController@paginate')
            ->name('qualifications.paginate');

        Route::post('/places/paginate', 'PlacesController@paginate')
            ->name('places.paginate');

        Route::post('/honors/paginate', 'HonorsController@paginate')
            ->name('honors.paginate');

        Route::post('/rebukes/paginate', 'RebukesController@paginate')
            ->name('rebukes.paginate');

        Route::post('/ranks/paginate', 'RanksController@paginate')
            ->name('ranks.paginate');

        Route::post('/educations/paginate', 'EducationsController@paginate')
            ->name('educations.paginate');
    });

    //Admin and moderator only controllers
    Route::group(['middleware' => 'can:moderate'], function(){
        Route::get('/export', 'Export\\ExportController')->name('export');


        Route::group(['namespace' => 'Import'], function(){
            //import users
            Route::get('/users/import', 'UsersImportController@getImport')->name('users.import');
            Route::post('/users/import', 'UsersImportController@postImport');
            Route::get('/users/importExample', 'UsersImportController@getExample')
                ->name('users.example');

            //import internships
            Route::get('/internships/import', 'InternshipsImportController@getImport')
                ->name('internships.import');
            Route::post('/internships/import', 'InternshipsImportController@postImport');
            Route::get('/internships/importExample', 'InternshipsImportController@getExample')
                ->name('internships.example');

            //import places
            Route::get('/places/import', 'PlacesImportController@getImport')
                ->name('places.import');
            Route::post('/places/import', 'PlacesImportController@postImport');
            Route::get('/places/importExample', 'PlacesImportController@getExample')
                ->name('places.example');

            //import publications
            Route::get('/publications/import', 'PublicationsImportController@getImport')
                ->name('publications.import');
            Route::post('/publications/import', 'PublicationsImportController@postImport');
            Route::get('/publications/importExample', 'PublicationsImportController@getExample')
                ->name('publications.example');

            //import qualifications
            Route::get('/qualifications/import', 'QualificationsImportController@getImport')
                ->name('qualifications.import');
            Route::post('/qualifications/import', 'QualificationsImportController@postImport');
            Route::get('/qualifications/importExample', 'QualificationsImportController@getExample')
                ->name('qualifications.example');
        });

        Route::resource('users', 'UsersController');
        Route::resource('commissions', 'CommissionsController');
        Route::resource('departments', 'DepartmentsController');
        Route::resource('publications', 'PublicationsController');
        Route::resource('places', 'PlacesController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('internships', 'InternshipsController');
        Route::resource('qualifications', 'QualificationsController');
        Route::resource('honors', 'HonorsController');
        Route::resource('rebukes', 'RebukesController');
        Route::resource('ranks', 'RanksController');
        Route::resource('educations', 'EducationsController');
    });

    //for administration of college
    Route::group(['middleware' => 'can:view'], function(){
        Route::resource('users', 'UsersController')
            ->only('index', 'show');

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

        Route::resource('honors', 'HonorsController')
            ->only('index', 'show');

        Route::resource('rebukes', 'RebukesController')
            ->only('index', 'show');

        Route::resource('ranks', 'RanksController')
            ->only('index', 'show');

        Route::resource('educations', 'EducationsController')
            ->only('index', 'show');
    });

    //user profile routes
    Route::group(['namespace' => 'Profile', 'prefix' => 'profile'], function(){
        Route::post('/publications/paginate', 'PublicationsController@paginate')
            ->name('profile.publications.paginate');

        Route::post('/internships/paginate', 'InternshipsController@paginate')
            ->name('profile.internships.paginate');

        Route::post('/qualifications/paginate', 'QualificationsController@paginate')
            ->name('profile.qualifications.paginate');

        Route::post('/educations/paginate', 'EducationsController@paginate')
            ->name('profile.educations.paginate');

        Route::post('/rebukes/paginate', 'RebukesController@paginate')
            ->name('profile.rebukes.paginate');

        Route::get('/rebukes/{id}', 'RebukesController@show')
            ->name('profile.rebukes.show');

        Route::post('/honors/paginate', 'HonorsController@paginate')
            ->name('profile.honors.paginate');

        Route::get('/honors/{id}', 'HonorsController@show')
            ->name('profile.honors.show');

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

        Route::resource('educations', 'EducationsController', [
            'as' => 'profile'
        ]);
    });
});
