<?php

namespace Blooengine\Models;

use Blooengine\Components\Db;
use PDO;

/**
 * Класс Category - модель для работы с категориями товаров
 */
class Category implements Model
{

    /**
     * Метод, позвооляющий получить количество страниц
     * @return mixed Количество страниц
     */
    public static function getTotalPages()
    {
        $db = Db::getConnection();
        $res = $db->query("SELECT COUNT(*) FROM `product`");
        $row = $res->fetch();
        return $row[0];
    }

    /**
     * Возвращает массив категорий для списка на сайте
     * @return array <p>Массив с категориями</p>
     */
    public static function getCategoriesList(): array
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, parent_id FROM category WHERE status = "1" ORDER BY sort_order, name ASC');

        // Получение и возврат результатов
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['parent_id'] = $row['parent_id'];
            $i++;
        }
        return $categoryList;
    }


    public static function getCategoriesListAdmin(): array
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, sort_order, status, parent_id FROM category ORDER BY sort_order ASC');

        // Получение и возврат результатов
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $categoryList[$i]['parent_id'] = $row['parent_id'];
            $i++;
        }
        return $categoryList;
    }


    /**
     * Возвращает массив категорий для списка в админпанели <br/>
     * (при этом в результат попадают и включенные и выключенные категории)
     * @return array <p>Массив категорий</p>
     */
    public static function getCategoriesListAdminByName($query): array
    {
        // Соединение с БД
        $db = Db::getConnection();
        $query = trim($query);
        //    $query = mysql_real_escape_string($query);
        $query = htmlspecialchars($query);
        // Запрос к БД
        $result = $db->query("SELECT id, name, sort_order, status, parent_id
                  FROM `category` WHERE `name` LIKE '%$query%'");

        // Получение и возврат результатов
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $categoryList[$i]['parent_id'] = $row['parent_id'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Удаляет категорию с заданным id
     * @param integer $id
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteCategoryById(int $id): bool
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM category WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирование категории с заданным id
     * @param integer $id <p>id категории</p>
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateCategoryById(int $id, string $name, int $sortOrder, int $status, int $parent_id): bool
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE category
            SET
                name = :name,
                sort_order = :sort_order,
                status = :status,
                parent_id = :parent_id
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает категорию с указанным id
     * @param integer $id <p>id категории</p>
     * @return array <p>Массив с информацией о категории</p>
     */
    public static function getCategoryById(int $id): array
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM category WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }

    /**
     * Возвращает текстое пояснение статуса для категории :<br/>
     * <i>0 - Скрыта, 1 - Отображается</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getStatusText(int $status): string
    {
        switch ($status) {
            case '1':
                return 'Отображается';
            case '0':
                return 'Скрыта';
            default:
                return '';
        }
    }

    /**
     * Добавляет новую категорию
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат добавления записи в таблицу</p>
     */
    public static function createCategory(string $name, int $sortOrder, int $status, int $parent_id = 0): bool
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO category (name, sort_order, status, parent_id) '
            . 'VALUES (:name, :sort_order, :status, :parent_id)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Метод для создания таблицы Category
     * @return bool Создана ли таблица
     */
    public static function createTable(string $db_name): bool
    {
        $db = Db::getConnection();

        $query = "CREATE TABLE IF NOT EXISTS {$db_name}.category (id INT NOT NULL AUTO_INCREMENT, name VARCHAR(512) NOT NULL, sort_order INT NOT NULL DEFAULT '0', status INT NOT NULL DEFAULT '0', parent_id INT DEFAULT '0', PRIMARY KEY (`id`))";
        $result = $db->prepare($query);
        return $result->execute();
    }

    /**
     * Метод, позволяющий получить все данные из таблицы Category
     * @return array Данные из таблицы Category
     */
    public static function getAllFromTable(): array
    {
        $db = Db::getConnection();
        $query = "SELECT * FROM category;";
        $result = $db->prepare($query);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchall();
    }
}
