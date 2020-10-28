<?php
require_once './vendor/autoload.php';
require_once './constants.php';
require_once './functions.php';
require_once './routes.php';

$app = Mubangizi\Application::instance();
$app->run();
