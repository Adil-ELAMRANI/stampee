<?php
use App\Routes\Route;
use App\Controllers\TimbreController;

Route::get('/', 'HomeController@index');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

Route::get('/hello', 'TestController@hello');

// CRUD Utilisateur
Route::get('/utilisateur', 'UtilisateurController@index');
Route::get('/utilisateur/create', 'UtilisateurController@create');
Route::post('/utilisateur/create', 'UtilisateurController@store');
Route::get('/utilisateur/edit', 'UtilisateurController@edit');
Route::post('/utilisateur/update', 'UtilisateurController@update');
Route::get('/utilisateur/delete', 'UtilisateurController@delete');

// CRUD Timbre
Route::get('/timbre', 'TimbreController@index');
Route::get('/timbre/create', 'TimbreController@create');
Route::post('/timbre/store', 'TimbreController@store');
Route::get('/timbre/edit', 'TimbreController@edit');
Route::post('/timbre/update', 'TimbreController@update');
Route::get('/timbre/delete', 'TimbreController@delete');

// CRUD Enchère
Route::get('/enchere', 'EnchereController@index');             
Route::get('/enchere/create', 'EnchereController@create');     
Route::post('/enchere/create', 'EnchereController@store');     
Route::get('/enchere/edit', 'EnchereController@edit');         
Route::post('/enchere/update', 'EnchereController@update');    
Route::get('/enchere/delete', 'EnchereController@delete');     


Route::dispatch();


