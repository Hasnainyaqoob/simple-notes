<?php

use Illuminate\Support\Facades\Route;
use \App\Providers\RouteServiceProvider;

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

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/notes', NoteController::class)->middleware(['auth']);*/

Auth::routes();

Route::resource('/notes', NoteController::class)->middleware(['auth']);

Route::get('/trashed', 'TrashedNoteController@index')
    ->middleware('auth')->name('trashed.index');
Route::get('/trashed/{note}', 'TrashedNoteController@show')
    ->middleware('auth')->name('trashed.show');
Route::put('/trashed/{note}', 'TrashedNoteController@update')
    ->middleware('auth')->name('trashed.update');
Route::delete('trashed/{note}', 'TrashedNoteController@destroy')
    ->middleware('auth')->name('trashed.destroy');

Route::get('/home', 'HomeController@index')->name('home');
