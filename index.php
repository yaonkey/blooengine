<?php

// Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение файлов системы
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/components/Autoload.php');

use Blooengine\Components\Router;
use Blooengine\Components\Functions;

session_start();

if (!Functions::isLock() && !\Blooengine\Components\Db::checkConnection()) {
    print_r("go to route <a href='/createadmin'>/createadmin</a> for create admin<br>");
}


// Вызов Router
$router = new Router();
$router->run();
