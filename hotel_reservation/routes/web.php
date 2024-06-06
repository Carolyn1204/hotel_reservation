<?php

use Illuminate\Support\Facades\Route;

Route::get('/index', 'App\Http\Controllers\CustomerController@index') -> name('index');
// Route::post('/index', 'App\Http\Controllers\CustomerController@registration') -> name('registration');
// Route::get('/login', 'App\Http\Controllers\CustomerController@login') ;


Route::post('/registration', 'App\Http\Controllers\CustomerController@registration') -> name('registration');
Route::post('/login', 'App\Http\Controllers\CustomerController@login') -> name('login');
Route::post('/logout', 'App\Http\Controllers\CustomerController@logout') -> name('logout');

Route::post('/search', 'App\Http\Controllers\reservationController@search') -> name('search');
Route::get('/reservation', 'App\Http\Controllers\reservationController@reservation') -> name('reservation');
Route::post('/submit_reservation', 'App\Http\Controllers\reservationController@submit_reservation') -> name('submit_reservation');
Route::get('/my_reservation', 'App\Http\Controllers\myReservationController@my_reservation') -> name('my_reservation');
