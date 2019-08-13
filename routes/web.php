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

Route::get('/', 'HomeController@index')->name('home');
Route::resource('disciplines', 'DisciplinesController');
Route::view('/admin', 'admin.settings')->name('admin');

Route::get('/disciplines/{discipline}/{group}', 'EntryController@startEntries')->name('entry.action');

Route::match(array('GET', 'POST'),'/disciplines/{discipline}/{group}/{student}', 'EntryController@nextEntry')->name('entry.next');

Route::get('/disciplines/{discipline}/{group}/summary', 'EntryController@nextEntry')->name('entry.summary'); //ToDO Route via /summary to finish inputs

Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
