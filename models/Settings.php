<?php

namespace Blooengine\Models;

use Blooengine\Components\Db;
use PDO;

class Settings implements Model
{
    /**
     * Метод для создания таблицы Settings
     * @return bool Создана ли таблица
     */
    public static function createTable(string $db_name): bool
    {
        $db = Db::getConnection();

        $query = "CREATE TABLE IF NOT EXISTS {$db_name}.settings (site_name VARCHAR(512) NOT NULL, author_email VARCHAR(512), is_available INT NOT NULL DEFAULT 1)";
        $result = $db->prepare($query);
        return $result->execute();
    }

    /**
     * Метод, позволяющий получить все данные из таблицы Settings
     * @return array Данные из таблицы Settings
     */
    public static function getAllFromTable(): array
    {
        $db = Db::getConnection();
        $query = "SELECT * FROM settings;";
        $result = $db->prepare($query);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchall();
    }
}