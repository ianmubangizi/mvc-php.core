<?php

use Mubangizi\Route;

Route::set('/user-profile', 'profile', 'UserController@index');
Route::set('/admin-dashboard', 'dashboard', 'UserController@index');

