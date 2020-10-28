<?php
// Auth Routes
use Mubangizi\Route;

Route::set('/auth/sign-in', 'sign-in', 'AuthController@sign_in');
Route::set('/auth/sign-up', 'sign-up', 'AuthController@sign_up');
Route::set('/auth/reset-password', 'reset-password', 'AuthController@recovery');


// Auth Function
Route::set('/auth/sign-out', 'sign-out', function () {
    if (get_user()->role === ANONYMOUS) {
        header('location: ' . url_for('sign-in'));
    } elseif(get_user()->role !== ANONYMOUS) {
        clear_session();
        header('location: ' . url_for('index') . '?alert=sign-out-success');
    }
});