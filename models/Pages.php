<?php

namespace Blooengine\Models;

use Blooengine\Components\Db;
use PDO;

class Pages implements Model
{

    /**
     * Метод для создания таблицы Pages
     * @return bool Создана ли таблица
     */
    public static function createTable(string $db_name): bool
    {
        $db = Db::getConnection();

        $query = "CREATE TABLE IF NOT EXISTS {$db_name}.pages (id INT NOT NULL AUTO_INCREMENT, title VARCHAR(128) NOT NULL, `text` text NOT NULL, status INT NOT NULL DEFAULT '0', PRIMARY KEY (`id`))";
        $result = $db->prepare($query);
        return $result->execute();
    }

    /**
     * Метод, позволяющий получить все данные из таблицы Pages
     * @return array Данные из таблицы Pages
     */
    public static function getAllFromTable(): array
    {
        $db = Db::getConnection();
        $query = "SELECT * FROM pages;";
        $result = $db->prepare($query);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchall();
    }
}