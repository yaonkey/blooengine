<?php

namespace Blooengine\Components;

/**
 * Класс Db
 * Компонент для работы с базой данных
 */
class Db
{

    /**
     * Устанавливает соединение с базой данных
     * @return PDO <p>Объект класса PDO для работы с БД</p>
     */
    public static function getConnection(): PDO
    {
        // Получаем параметры подключения из файла
        $params = include(ROOT . '/config/db_params.php');

        // Устанавливаем соединение
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        // Задаем кодировку
        $db->exec("set names utf8");
        return $db;
    }

}
