<?php

use Mubangizi\Route;
use Mubangizi\Views\Page;
use Mubangizi\Models\User;
use Mubangizi\Layouts\Alert;
use Mubangizi\Layouts\Toast;
use Mubangizi\Application;

function get_user(): ?User
{
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    return new User();
}

function is_auth($role = ADMINISTRATOR)
{
    if (get_user()->role !== ANONYMOUS) {
        return get_user()->role === $role;
    }
    return false;
}

function site()
{
    return Application::instance()->name ?: "";
}

function site_name($name)
{
    return Application::instance()->name = $name;
}

function get_page()
{
    return Application::instance()->page;
}

function get_alert()
{
    if (isset(get_page()->data['alert'])) {
        return get_page()->data['alert'];
    }
    return null;
}

function array_has(&$array, ...$keys)
{
    $index = sizeof($keys) - 1;
    $key = $keys[$index];
    unset($keys[$key]);
    return $index >= 0
        ? isset($array[$key])
        : array_has($array, $keys);
}

function url_for($name)
{
    return strpos($name, '@') === 0
        ? Route::$urls['POST'][$name]
        : Route::$urls['GET'][$name];
}

function get_title()
{
    if (get_page()->title !== '')
        return site() . " | " . get_page()->title;
    return site();
}

function get_cookie($cookie)
{
    return isset($_COOKIE[$cookie]) ? $_COOKIE[$cookie] : null;
}

function clear_session()
{
    session_unset();
    session_destroy();
}

function alert($title, $text, $icon = false, $status = false)
{
    Application::instance()->alert = new Alert($title, $text, 'show', $icon, $status);
}

function toast($title, $body, $status, $icon, $position, $params)
{
    Application::instance()->toast = new Toast($title, $body, 'show', $status, $icon, $position, $params);
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

function trim_string($input, $length, $ellipses = true, $strip_html = true)
{
    if ($strip_html) {
        $input = strip_tags($input);
    }

    if (strlen($input) <= $length) {
        return $input;
    }

    $last_space = strrpos(substr($input, 0, $length), ' ');
    if ($last_space !== false) {
        $trimmed_text = substr($input, 0, $last_space);
    } else {
        $trimmed_text = substr($input, 0, $length);
    }
    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
}

function path_for($dir)
{
    return Application::$paths[$dir];
}

function view($view, $path = false)
{
    return path_for($path ?: 'pages') . "$view.php";
}

function layouts($file, $path = false)
{
    $layout = $path
        ? path_for($path) . $file
        : path_for('layouts') . $file;
    return "$layout.php";
}

function render(Page $page, $view = null, $data = null, $title = null)
{
    if ($data != null) $page->data = $data;
    if ($view != null) $page->view = $view;
    if ($title != null) $page->title = $title;
    $page->render($page);
}

function static_file($path, $name, $root = '/public')
{
    return "$root/$path/$name";
}

function crumb($title, $url = 'index', $root = false)
{
    return array(
        'root' => $url === 'index' ?: $root,
        'title' => $title,
        'url' => url_for($url)
    );
}

function breadcrumbs(&$request, $name, $array)
{
    $request['breadcrumbs'][$name] = $array;
}


function form_data(&$request, $form, $data)
{
    $request['form-data'][$form] = $data;
}

function get_form_data()
{
    if (isset(get_page()->data['form-data'])) {
        return get_page()->data['form-data'];
    };
    return null;
}

function set_page_tab($path, $default = '')
{
    return isset($_REQUEST['tab']) && file_exists(view("$path\\" . $_REQUEST['tab']))
        ? $_REQUEST['tab'] : $default;
}

function is_active_tab($name)
{
    if (isset($_REQUEST['tab'])) {
        return $_REQUEST['tab'] === $name;
    }
    return false;
}


function active_tab($name, $tab = false): string
{
    if (is_active_tab($name)) {
        return ' active';
    } elseif ($tab !== false && $tab === $name) {
        return ' active';
    }
    return ' ';
}

function rand_color($min = 0, $max = 0xFFFFFF)
{
    return sprintf('#%06X', mt_rand($min, $max));
}

function file_upload($file, $storage_path = '\\public\\img\\uploads\\', $file_ext = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'])
{
    try {
        if (!isset($_FILES[$file]['error']) || is_array($_FILES[$file]['error'])) {
            throw new RuntimeException('Invalid parameters.');
        }

        switch ($_FILES[$file]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded file size limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        if ($_FILES[$file]['size'] > 1000000) {
            throw new RuntimeException('Exceeded file size limit.');
        }

        $info = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search($info->file($_FILES[$file]['tmp_name']), $file_ext, true)) {
            throw new RuntimeException('Invalid file format.');
        }

        $__file = sprintf("$storage_path%s.%s", sha1_file($_FILES[$file]['tmp_name']), $ext);
        if (!move_uploaded_file($_FILES[$file]['tmp_name'], __DIR__ . $__file)) {
            throw new RuntimeException('Failed to move uploaded file.');
        }

        return array('file' => $__file, 'msg' => 'File Upload Complete');
    } catch (RuntimeException $e) {
        return array('error' => $e->getMessage());
    }
}
