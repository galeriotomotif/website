<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!php
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('blog/{slug}', 'PostController@show')->name('post.show');
Route::get('{slug}', 'PageController@show')->name('page.show');

Route::get('files/{file_name?}', 'FileController@showFile')
    ->where('file_name', '.*')
    ->name('file.show.file');
