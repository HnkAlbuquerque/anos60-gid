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

Route::get('/','Principal\PrincipalController@index');
Route::get('/ofertaformfirst','Principal\PrincipalController@ofertaViewFirst');
Route::get('/ofertaformsecond','Principal\PrincipalController@ofertaViewSecond');


Route::post('/ofertaformfinish','Principal\PrincipalController@ofertaViewFinish');



/// AJAX ROUTES
Route::get('/getmember/{cpf}','Principal\PrincipalController@getMember');
Route::get('/htmlrequest/{type}','Principal\PrincipalController@htmlrequest');
Route::get('/ofertarequest/{cpf}','Principal\PrincipalController@listOferta');
