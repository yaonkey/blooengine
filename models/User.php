<?php

namespace Blooengine\Models;

use Blooengine\Components\Db;
use PDO;

/**
 * Класс User - модель для работы с пользователями
 */
class User implements Model
{

    /**
     * Проверка на администратора
     * @param $uid
     * @return boolean
     */
    public static function checkAdmin($uid): bool
    {
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE id = :id AND role = "admin"';
        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $uid, PDO::PARAM_INT);
        $result->execute();

        // Обращаемся к записи
        $user = $result->fetch();

        if ($user) {
            // Если запись существует, возвращаем id пользователя
            return $user['id'];
        }
        return false;
    }

    /**
     * Регистрация пользователя
     * @param string $name <p>Имя</p>
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function register(string $name, string $email, string $password): bool
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "INSERT INTO user (name, email, password) VALUES (':name', ':email', ':password')";

        $pass = hash('sha256', $password);

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $pass, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Редактирование данных пользователя
     * @param integer $id <p>id пользователя</p>
     * @param string $name <p>Имя</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function edit(int $id, string $name, string $password): bool
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Пароль</p>
     * @return mixed : integer user id or false
     */
    public static function checkUserData(string $email, string $password): mixed
    {
        // Соединение с БД
        $db = Db::getConnection();
        $pass = hash('sha256', $password);

        // Текст запроса к БД
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$pass'";

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->execute();

        // Обращаемся к записи
        $user = $result->fetch();

        if ($user) {
            $_SESSION['email'] = $user['email'];
            // Если запись существует, возвращаем id пользователя
            return $user['id'];
        }
        return false;
    }

    /**
     * Запоминаем пользователя
     * @param integer $userId <p>id пользователя</p>
     */
    public static function auth(int $userId): void
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован.<br/>
     * Иначе перенаправляет на страницу входа
     * @return string <p>Идентификатор пользователя</p>
     */
    public static function checkLogged(): string
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    /**
     * Проверяет является ли пользователь гостем
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function isGuest(): bool
    {
        return !isset($_SESSION['user']);
    }

    /**
     * Проверяет имя: не меньше, чем 2 символа
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkName(string $name): bool
    {
        return (strlen($name) >= 2);
    }

    /**
     * Проверяет телефон: не меньше, чем 10 символов
     * @param string $phone <p>Телефон</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPhone(string $phone): bool
    {
        return strlen($phone) >= 10 && preg_match("/[+7,8][0-9]{10,10}+$/", $phone);
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPassword(string $password): bool
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет не занят ли email другим пользователем
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmailExists(string $email): bool
    {
        // Соединение с БД        
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id <p>id пользователя</p>
     * @return array <p>Массив с информацией о пользователе</p>
     */
    public static function getUserById(int $id): array
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Метод для создания таблицы User
     * @return bool Создана ли таблица
     */
    public static function createTable(string $db_name): bool
    {
        $db = Db::getConnection();

        $query = "CREATE TABLE IF NOT EXISTS {$db_name}.user (id INT NOT NULL AUTO_INCREMENT, role varchar(64) NOT NULL DEFAULT 'user', name VARCHAR(512) NOT NULL, phone VARCHAR(128), email varchar(512), password TEXT NOT NULL, PRIMARY KEY (`id`))";
        $result = $db->prepare($query);
        return $result->execute();
    }

    /**
     * Метод, позволяющий получить все данные из таблицы User
     * @return array Данные из таблицы User
     */
    public static function getAllFromTable(): array
    {
        $db = Db::getConnection();
        $query = "SELECT * FROM user;";
        $result = $db->prepare($query);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchall();
    }

    /**
     * Регистрация первого администратора
     * @param string $name <p>Имя</p>
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function createSuperadmin(string $name, string $email, string $password): bool
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "INSERT INTO user (`name`, `email`, `password`, `role`) VALUES (':name', ':email', ':password', 'admin')";

        $pass = hash('sha256', $password);

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $pass, PDO::PARAM_STR);
        return $result->execute();
    }

}
