<?php

/**
 * Функция __autoload для автоматического подключения классов
 */

spl_autoload_register(function ($class_name) {
    // Массив папок, в которых могут находиться необходимые классы
    $class_name = explode("\\", $class_name)[2];
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    // Проходим по массиву папок
    foreach ($array_paths as $path) {
//        $class_name = strtolower($class_name);
        $namespace=str_replace("\\","/",__NAMESPACE__);
        $class_name=str_replace("\\","/",$class_name);
        $class=ROOT.$path.(empty($namespace)?"":$namespace."/")."{$class_name}.class.php";

        // Формируем имя и путь к файлу с классом
        $path = ROOT . $path . $class_name . '.php';

        // Если такой файл существует, подключаем его
        if (is_file($path)) {
            include_once $path;
        }
    }
});
