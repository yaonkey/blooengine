<?php

namespace Blooengine\Components;

use Blooengine\Models\Category;
use Blooengine\Models\Order;
use Blooengine\Models\Pages;
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
     * @return PDO|false <p>Объект класса PDO для работы с БД</p>
     */
    public static function getConnection(): PDO|false
    {
        // Получаем параметры подключения из файла
        $params = include(ROOT . '/config/db_params.php');

        // Устанавливаем соединение
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        try {
            return new PDO($dsn, $params['user'], $params['password']);
        } catch (PDOException $e) {
            print_r("{$e}");
        }
        return false;
    }

    public static function firstInit(string $siteName, string $siteEmail): void
    {
        print_r("\nFirst init on database! Reload page!\n");
        $params = include(ROOT . '/config/db_params.php');
        $queryForCreateDB = "CREATE DATABASE IF NOT EXISTS {$params['dbname']}";

        $dsn = "mysql:host={$params['host']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec($queryForCreateDB);

        Category::createTable($params['dbname']);
        Order::createTable($params['dbname']);
        Product::createTable($params['dbname']);
        $settings = new Settings($siteName, $siteEmail);
        $settings->createFTable($params['dbname']);
        User::createTable($params['dbname']);
        Pages::createTable($params['dbname']);
    }

    public static function checkConnection(): bool
    {
        $params = include(ROOT . '/config/db_params.php');
        $db = $params['dbname'];
        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'";
        $dsn = "mysql:host={$params['host']};dbname=INFORMATION_SCHEMA";
        $checker = new PDO($dsn, $params['user'], $params['password']);
        $result = $checker->prepare($sql);
        $result->execute();
        return $result->fetch();
    }

}
