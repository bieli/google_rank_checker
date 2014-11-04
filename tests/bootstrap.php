<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

date_default_timezone_set('UTC');

set_include_path(
    get_include_path() .
    PATH_SEPARATOR . dirname(__DIR__) .
    PATH_SEPARATOR . dirname(__DIR__) . '/../src'
);

require_once __DIR__ . '/../vendor/autoload.php';
