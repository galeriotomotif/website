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

Auth::routes(['register' => false, 'logout' => false]);
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['auth', 'role:developer|superadmin'])->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('datatables', 'UserController@datatables')->name('datatables');
        Route::get('datatables/structure', 'UserController@datatablesStructure')->name('datatables.structure');
    });

    Route::resource('user', 'UserController')->names('user');

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('datatables', 'CategoryController@datatables')->name('datatables');
        Route::get('datatables/structure', 'CategoryController@datatablesStructure')->name('datatables.structure');
    });

    Route::prefix('page')->name('page.')->group(function () {
        Route::get('datatables', 'PageController@datatables')->name('datatables');
        Route::get('datatables/structure', 'PageController@datatablesStructure')->name('datatables.structure');
    });

    Route::resource('page', 'PageController')->names('page');

    Route::resource('category', 'CategoryController')->names('category');

    Route::prefix('tag')->name('tag.')->group(function () {
        Route::get('datatables', 'TagController@datatables')->name('datatables');
        Route::get('datatables/structure', 'TagController@datatablesStructure')->name('datatables.structure');
    });

    Route::resource('tag', 'TagController')->names('tag');

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('datatables', 'PostController@datatables')->name('datatables');
        Route::get('datatables/structure', 'PostController@datatablesStructure')->name('datatables.structure');
    });

    Route::resource('post', 'PostController')->names('post');
});

