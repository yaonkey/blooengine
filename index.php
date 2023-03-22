<?php

// Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение файлов системы
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/components/Autoload.php');

use Blooengine\Components\Router;

session_start();

try {
    if (!\Blooengine\Components\Db::checkConnection()) {

    }
} catch (PDOException $e) {
    print_r($e);
}

// Вызов Router
$router = new Router();
$router->run();
