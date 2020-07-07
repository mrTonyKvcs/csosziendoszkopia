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
Route::get('idopontok', function() {
  $formatter = function ($time) {
    if ($time % 3600 == 0) {
      return date('ga', $time);
    } else {
      return date('g:ia', $time);
    }
  };
  $halfHourSteps = range(0, 47*1800, 1800);
  return array_map($formatter, $halfHourSteps);
});

Route::get('/', [ 'as' => 'pages.index', 'uses' => 'PagesController@index']);
Route::get('orvosok/{slug}', [ 'as' => 'pages.doctor', 'uses' => 'PagesController@doctor']);
Route::get('arak', [ 'as' => 'pages.prices', 'uses' => 'PagesController@prices']);

//Appointments
Route::get('online-bejelentkezes', [ 'as' => 'appointments.index', 'uses' => 'AppointmentsController@index']);
Route::post('online-bejelentkezes/uj-bejelentkezo', [ 'as' => 'appointments.store', 'uses' => 'AppointmentsController@store']);
Route::get('online-bejelentkezes-befejezese', 'AppointmentsController@greeting');

//Login
Auth::routes(['register' => false]);

//Admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');

    //Consultations
    Route::get('rendelesek', ['as' => 'admin.consultations.index', 'uses' => 'Admin\ConsultationsController@index']);
    Route::get('rendelesek/uj-rendeles', ['as' => 'admin.consultations.create', 'uses' => 'Admin\ConsultationsController@create']);
    Route::post('rendelesek/uj-rendeles', ['as' => 'admin.consultations.store', 'uses' => 'Admin\ConsultationsController@store']);
    Route::delete('/rendelesek/{id}', [ 'as' => 'admin.consultations.destroy', 'uses' => 'Admin\ConsultationsController@destroy']);

    Route::get('/idopontok', [ 'as' => 'admin.appointments.index', 'uses' => 'Admin\AppointmentsController@index']);
    Route::get('/idopontok/uj-letrehozas', [ 'as' => 'admin.appointments.create', 'uses' => 'Admin\AppointmentsController@create']);
    Route::post('/idopontok/uj-letrehozas', [ 'as' => 'admin.appointments.store', 'uses' => 'Admin\AppointmentsController@store']);
    Route::delete('/idopontok/{id}', [ 'as' => 'admin.appointments.destroy', 'uses' => 'Admin\AppointmentsController@destroy']);
});
