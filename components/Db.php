<?php

namespace Blooengine\Components;

use Blooengine\Models\Category;
use Blooengine\Models\Order;
use Blooengine\Models\Product;
use Blooengine\Models\Settings;
use Blooengine\Models\User;
use PDO;
use PDOException;

/**
 * Класс Db
 * Компонент для работы с базой данных
 */
class Db
{

    /**
     * Устанавливает соединение с базой данных
     * @return PDO|false|array <p>Объект класса PDO для работы с БД</p>
     */
    public static function getConnection(): PDO|false
    {
        // Получаем параметры подключения из файла
        $params = include(ROOT . '/config/db_params.php');

        // Устанавливаем соединение
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        try {
            $db = new PDO($dsn, $params['user'], $params['password']);

            return $db;
        } catch (PDOException $e) {
            print_r("{$e}");
            self::firstInit($params);
        }
        return false;
    }

    private static function firstInit($params): void
    {
        print_r("\nFirst init on database! Reload page!\n");
        $queryForCreateDB = "CREATE DATABASE IF NOT EXISTS {$params['dbname']}";

        $dsn = "mysql:host={$params['host']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec($queryForCreateDB);
        Category::createTable($params['dbname']);
        Order::createTable($params['dbname']);
        Product::createTable($params['dbname']);
        Settings::createTable($params['dbname']);
        User::createTable($params['dbname']);

        header("/admin");

    }

}
