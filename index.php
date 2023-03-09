<?php

use Blooengine\Components\Router;

// Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Подключение файлов системы
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/components/Autoload.php');


// Вызов Router
$router = new Router();
$router->run();
