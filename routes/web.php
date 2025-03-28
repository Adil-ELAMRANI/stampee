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







Route::dispatch();


