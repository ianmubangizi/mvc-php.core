<?php

use Mubangizi\Route;

Route::add('/', 'index');
Route::add('/server-error', '500');
Route::add('/page-not-found', '404');
