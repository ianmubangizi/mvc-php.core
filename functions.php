<?php

use Mubangizi\Route;

function url_for($name)
{
    return Route::$urls[$name];
}
