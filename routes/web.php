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

use Illuminate\Http\Request;

Route::view('/', 'welcome')->name('main');
Route::get('/', 'HomeController@index')->name('home');

//FROM HERE ON, ENTIRE APPLICATION HAS RESTRICTED ACCESS

Route::group(['middleware' => ['auth']], function() {


//MANAGEMENT OF THE APPLICATION

    Route::post('/admin/listUpload', 'ListUploadController@store')->name('admin.list.upload');
    Route::view('/admin/upload', 'admin.settings')->name('admin');
    Route::get('/admin/accounts', 'AccountsController@resetPasswords')->name('admin.accounts');
    Route::get('/admin/{id}/reset', 'AccountsController@resetThisAccount')->name('admin.reset');
    Route::get('/admin/{id}/suspend', 'AccountsController@suspendThisAccount')->name('admin.suspend');
    Route::get('/admin/{id}/activate', 'AccountsController@activateThisAccount')->name('admin.activate');

//ENTRY ROUTES

    Route::resource('disciplines', 'DisciplinesController');
    Route::get('/disciplines/{discipline}/{group}', 'EntryController@startEntries')->name('entry.action');
    Route::get('/disciplines/{discipline}/{group}/{student}/edit', 'EntryController@editEntry')->name('entry.edit');
    Route::match(array('GET', 'POST'),'/disciplines/{discipline}/{group}/{student}/skipFlag={skipFlag}', 'EntryController@nextEntry')->name('entry.next');
    Route::get('/disciplines/{discipline}/{group}/summary', 'EntryController@nextEntry')->name('entry.summary'); //ToDO Route via /summary to finish inputs
    Route::post('/{discipline}/{group}/success', 'ValuesController@store')->name('entry.store');

//STATS ROUTES

    Route::get('/stats', 'StatsController@selection')->name('stats.select');
    Route::get('/stats/{mode}', 'StatsController@searchByDiscipline')->name('stats.discipline');
    Route::post('/stats/result', 'StatsController@deliver')->name('stats.deliver');
    Route::post('/stats/detailedSearch', 'StatsController@detailSearch')->name('stats.detail');
    Route::post('/stats/result/final', 'StatsController@deliverDetail')->name('stats.deliverDetail');
    Route::get('/stats/{discipline_id}/{mode}/{gender}/{useAge}/{age}/{class}/{limit}/{upper}/download', 'StatsController@downloadPDF')->name('stats.download');
    Route::get('/stats/latest/download', 'StatsController@downloadLatestPDF')->name('stats.downloadLatest');

//AUTH ROUTES

    Route::get('/newPassword', 'PersonalPasswordController@newPassword')->name('auth.newPW');
    Route::post('/passwordSuccess', 'PersonalPasswordController@savePassword')->name('auth.savePW');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::get('/logout', 'Auth\LoginController@logout');


