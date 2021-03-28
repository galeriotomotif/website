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

Route::get('sitemap/{path?}', 'SiteMapController@show')
    ->where('path', '.*')
    ->name('site-map.show');

Route::get('files/{path?}', 'FileController@showFile')
    ->where('path', '.*')
    ->name('file.show.file');

Route::get('photos/{ratio}/files/{path}', 'FileController@showImageAspecRatio')->where('path', '.*')
    ->name('photos.ratio.path');


Route::get('/', 'HomeController@index')->name('home');
Route::get('blog/{slug}', 'PostController@show')->name('post.show');
Route::get('{slug}', 'PageController@show')->name('page.show');
Route::get('amp/blog/{slug}', 'PostController@showAmp')->name('amp.post.show');
