<?php
use Mubangizi\Route;

// Page Routes
Route::set('/', 'index');
Route::get('/about-us', 'about-us');
Route::get('/contact-us', 'contact-us');

//Error Routes
Route::get('/server-error', 'server-error');
Route::get('/page-not-found', 'page-not-found');