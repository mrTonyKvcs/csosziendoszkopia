<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. groupNow create something great!
|
*/
Route::get('/callback', function () {
    \Log::info($_SERVER);
});

Route::get('/', [ 'as' => 'pages.index', 'uses' => 'PagesController@index']);
Route::get('orvosok/{slug}', [ 'as' => 'pages.doctor', 'uses' => 'PagesController@doctor']);

//Appointments
Route::get('online-bejelentkezes', [ 'as' => 'appointments.index', 'uses' => 'AppointmentsController@index']);
Route::post('online-bejelentkezes/uj-bejelentkezo', [ 'as' => 'appointments.store', 'uses' => 'AppointmentsController@store']);

//Login
Auth::routes(['register' => false]);

//Admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/idopontok', [ 'as' => 'admin.appointments.index', 'uses' => 'Admin\AppointmentsController@index']);
    Route::get('/idopontok/uj-letrehozas', [ 'as' => 'admin.appointments.create', 'uses' => 'Admin\AppointmentsController@create']);
    Route::post('/idopontok/uj-letrehozas', [ 'as' => 'admin.appointments.store', 'uses' => 'Admin\AppointmentsController@store']);
    Route::delete('/idopontok/{id}', [ 'as' => 'admin.appointments.destroy', 'uses' => 'Admin\AppointmentsController@destroy']);
});
