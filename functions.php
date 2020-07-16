<?php

use Mubangizi\Route;

function url_for($name)
{
    return Route::$urls[$name];
}

function update_string($values, $length, $string = "")
{
    foreach ($values as $index => $value) {
        $string = $length-- > 1
            ? $string . "$index = $value,"
            : $string . "$index = $value";
    }
    return $string;
}

function insert_string(array $values, $length, $start = "(", $end = ")", $div = ",")
{
    $array = array(
        'key' => $start,
        'value' => $start
    );
    foreach ($values as $index => $value) {
        $array['key'] = make_string($array, $length, "`$index`", 'key', $div, $end);
        $array['value'] = make_string($array, $length, $value, 'value', $div, $end);
        $length--;
    }
    return $array;
}

function make_string(array $array, $length, $string, $key, $div, $end)
{
    return $length > 1
        ? $array[$key] . $string . $div
        : $array[$key] . $string . $end;
}
