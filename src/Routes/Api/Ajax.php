<?php

// AJAX Functions
use Mubangizi\Route;

Route::post('/ajax/functions', 'functions', function () {
    $functions = array(
        'remove_alert' => function () {
            get_page()->remove_alert();
        },
    );

    $data = json_decode(file_get_contents('php://input'), true);
    $function = $data['function'];
    if (isset($data['function']) & isset($functions[$function])) {
        $functions[$function]();
    }
});