<?php

namespace Blooengine\Components;

use Blooengine\Models\Settings;

/**
 * Класс Router
 * Компонент для работы с маршрутами
 */
class Router
{

    /**
     * Свойство для хранения массива роутов
     * @var array
     */
    private mixed $routes;
    public bool $noneFound = true;

    /**
     * Конструктор
     */
    public function __construct()
    {
        // Получаем роуты из файла
        $this->routes = include(ROOT . '/config/routes.php');
    }

    /**
     * Возвращает строку запроса
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Метод для обработки запроса
     */
    public function run(): void
    {
        // Получаем строку запроса
        $uri = $this->getURI();

        // Проверяем наличие такого запроса в массиве маршрутов (routes.php)
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                if ($uriPattern != $uri && $uri != '') continue;
                $this->noneFound = false;
                // Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Определить контроллер, action, параметры
                $segments = explode('/', $internalRoute);
                if ($segments[0] != 'createadmin') {
                    if (!defined('THEME')) {
                        $theme = Settings::getOptionValue("theme") ?: 'default';
                        define('THEME', ROOT . "/views/" . $theme . "/");
                    }
                }

                $controllerName = ucfirst(array_shift($segments) . 'Controller');

                $actionName = 'action' . ucfirst(array_shift($segments));

                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) include_once($controllerFile);

                // Создать объект, вызвать метод (т.е. action)
                try {
                    $controllerObject = new $controllerName;
                } catch (\Error) {
                    $this->noneFound = true;
                }
                try {
                    $result = call_user_func_array(array($controllerObject, $actionName), $segments);
                } catch (\Error) {
                }
            }
        }
        if ($this->noneFound) {
            include_once ROOT . '/views/default/404.php';
        }
    }
}
