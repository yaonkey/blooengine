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

        $query = "CREATE TABLE IF NOT EXISTS {$db_name}.settings (`option` VARCHAR(128) NOT NULL UNIQUE, `value` VARCHAR(512) NOT NULL, `comment` text)";
        $result = $db->prepare($query);
        self::firstInit();
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

    /**
     * Метод для получения названия темы сайта
     * @return string Наименование темы
     */
    public static function getThemeName(): string
    {
        $db = Db::getConnection();

        $query = "SELECT `value` FROM settings WHERE `option` = 'theme'";
        $result = $db->prepare($query);
        $result->execute();
        return $result->fetch();
    }

    /**
     * Метод для получения названия сайта
     * @return string Наименование сайта
     */
    public static function getSiteName(): string
    {
        $db = Db::getConnection();

        $query = "SELECT `value` FROM settings WHERE `option` = 'site_name'";
        $result = $db->prepare($query);
        $result->execute();
        return $result->fetch();
    }

    /**
     * Метод для получения email сайта
     * @return string Email сайта
     */
    public static function getSiteEmail(): string
    {
        $db = Db::getConnection();

        $query = "SELECT `value` FROM settings WHERE `option` = 'site_email'";
        $result = $db->prepare($query);
        $result->execute();
        return $result->fetch();
    }

    /**
     * Метод первой инициации таблицы
     * @param string $siteName Название сайта
     * @param string $siteEmail Email сайта
     * @return bool
     */
    private static function firstInit(string $siteName, string $siteEmail): bool
    {
        return
            self::addOption('site_name', $siteName, 'Option with site name') &&
            self::addOption('site_email', $siteEmail, 'Option with site email') &&
            self::addOption('is_available', '1', 'Is site available for all users') &&
            self::addOption('region', 'eu', 'Site region') &&
            self::addOption('theme', 'default', 'Option with site theme');
    }

    /**
     * Метод для добавления новых параметров в настройки
     * @param string $optionName Наименование параметра
     * @param string $optionValue Значение параметра
     * @param string $optionComment Комментарий параметра
     * @return bool
     */
    public static function addOption(string $optionName, string $optionValue, string $optionComment = ''): bool
    {
        $db = Db::getConnection();

        $query = "INSERT INTO settings VALUES (':option_name', ':option_value', ':option_comment')";
        $result = $db->prepare($query);
        $result->bindParam(':option_name', $optionName);
        $result->bindParam(':option_value', $optionValue);
        $result->bindParam(':option_comment', $optionComment);
        return $result->execute();
    }

    /**
     * Метод для изменения активной темы сайта
     * @param string $themeName Название темы сайта
     * @return bool
     */
    public static function changeTheme(string $themeName): bool
    {
        $db = Db::getConnection();

        $query = "UPDATE settings SET `value` = ':theme_name' WHERE `option` = 'theme'";
        $result = $db->prepare($query);
        $result->bindParam(':theme_name', $themeName);
        return $result->execute();
    }

    /**
     * Метод для изменения наименования сайта
     * @param string $siteName Наименование сайта
     * @return bool
     */
    public static function changeSiteName(string $siteName): bool
    {
        $db = Db::getConnection();

        $query = "UPDATE settings SET `value` = ':site_name' WHERE `option` = 'site_name'";
        $result = $db->prepare($query);
        $result->bindParam(':site_name', $siteName);
        return $result->execute();
    }

    /**
     * Метод для изменения почты сайта
     * @param string $siteEmail Почта сайта
     * @return bool
     */
    public static function changeSiteEmail(string $siteEmail): bool
    {
        $db = Db::getConnection();

        $query = "UPDATE settings SET `value` = ':site_email' WHERE  `option` = 'site_email'";
        $result = $db->prepare($query);
        $result->bindParam(':site_email', $siteEmail);
        return $result->execute();
    }

    /**
     * @param string $optionName Наименование параметра
     * @return string Значение параметра
     */
    public static function getOptionValue(string $optionName): string
    {
        $db = Db::getConnection();

        $query = "SELECT `value` FROM settings WHERE `option` = ':option_name'";
        $result = $db->prepare($query);
        $result->bindParam(':option_name', $optionName);
        return $result->fetch();
    }

    /**
     * Метод для получения комментария параметра
     * @param string $optionName Наименование параметра
     * @return string
     */
    public static function getOptionComment(string $optionName): string
    {
        $db = Db::getConnection();

        $query = "SELECT `comment` FROM settings WHERE `option` = ':option_name'";
        $result = $db->prepare($query);
        $result->bindParam(':option_name', $optionName);
        return $result->fetch();
    }
}