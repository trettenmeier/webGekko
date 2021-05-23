<?php

use Illuminate\Support\Facades\Route;

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

////////////////////// Alle Ressourcen (Namen, Interpretation der Werte, etc.) //////////////////////
Route::get('getAllResources', 'webGekkoController@getAllResources');

////////////////////// Alle Werte //////////////////////
Route::get('getValues', 'webGekkoController@getValues');


////////////////////// Türbezogen //////////////////////
// türöffner setzen
Route::get('setDoorLockStatus/{value}', 'webGekkoController@setDoorLockStatus');


////////////////////// Raumtemperatur //////////////////////
// alle Räume in Komfort (+ clocks ausschalten)
Route::get('setTempKomfort', 'webGekkoController@setTempKomfort');
// alle Räume in Absenk (+ clocks ausschalten)
Route::get('setTempAbsenk', 'webGekkoController@setTempAbsenk');
// alles in auto (clocks aktivieren)
Route::get('setTempAuto', 'webGekkoController@setTempAuto');

// solltemp ändern pro raum
Route::get('setTemp/{room}/{value}', 'webGekkoController@setTempSingleRoom');
// profil ändern pro raum
Route::get('setTempProfil/{room}/{value}', 'webGekkoController@setTempSingleRoomProfil');


////////////////////// Stromzähler //////////////////////
