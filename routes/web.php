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

Route::view('/', 'welcome')->name('main');
Route::get('/', 'HomeController@index')->name('home');
Route::resource('disciplines', 'DisciplinesController');
Route::view('/admin', 'admin.settings')->name('admin');
Route::post('/admin/listUpload', 'ListUploadController@store')->name('admin.list.upload');

Route::get('/disciplines/{discipline}/{group}', 'EntryController@startEntries')->name('entry.action');
Route::get('/disciplines/{discipline}/{group}/{student}/edit', 'EntryController@editEntry')->name('entry.edit');
Route::match(array('GET', 'POST'),'/disciplines/{discipline}/{group}/{student}/skipFlag={skipFlag}', 'EntryController@nextEntry')->name('entry.next');
Route::get('/disciplines/{discipline}/{group}/summary', 'EntryController@nextEntry')->name('entry.summary'); //ToDO Route via /summary to finish inputs

Route::get('/stats', 'StatsController@selection')->name('stats.select');
Route::get('/stats/{mode}', 'StatsController@searchByDiscipline')->name('stats.discipline');
Route::post('/stats/result', 'StatsController@deliver')->name('stats.deliver');
Route::post('/stats/detailedSearch', 'StatsController@detailSearch')->name('stats.detail');
Route::post('/stats/result/final', 'StatsController@deliverDetail')->name('stats.deliverDetail');

Route::get('/stats/{discipline_id}/{mode}/{gender}/{useAge}/{age}/{class}/download', 'StatsController@downloadPDF')->name('stats.download');
Route::get('/stats/latest/download', 'StatsController@downloadLatestPDF')->name('stats.downloadLatest');

Route::post('/{discipline}/{group}/success', 'ValuesController@store')->name('entry.store');

Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
