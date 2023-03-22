<?php

namespace Blooengine\Models;

use Blooengine\Components\Db;
use PDO;

class Settings implements Model
{
    private string $siteName;
    private string $siteEmail;

    public function __construct(string $siteName, string $siteEmail)
    {
        $this->siteName = $siteName;
        $this->siteEmail = $siteEmail;
    }

    public static function createTable(string $db_name): bool
    {
        return false;
    }

    /**
     * Метод для создания таблицы Settings
     * @return bool Создана ли таблица
     */
    public function createFTable(string $db_name): bool
    {
        $db = Db::getConnection();

        $query = "CREATE TABLE IF NOT EXISTS {$db_name}.settings (`option` VARCHAR(128) NOT NULL UNIQUE, `value` VARCHAR(512) NOT NULL, `comment` text)";
        $result = $db->prepare($query);
        $result->execute();
        $this->firstInit();
        return true;
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
     * @return void
     */
    private function firstInit(): void
    {
        self::addOption('site_name', $this->siteName, 'Option with site name') &&
        self::addOption('site_email', $this->siteEmail, 'Option with site email') &&
        self::addOption('is_available', '1', 'Is site available for all users') &&
        self::addOption('region', 'eu', 'Site region') &&
        self::addOption('theme', 'default', 'Option with site theme') &&
        self::addOption('lang', 'ru', 'Site language');
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

        $query = "INSERT INTO settings VALUES ('$optionName', '$optionValue', '$optionComment')";
        $result = $db->prepare($query);
        print_r($result);
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
     * Метод для изменения языка сайта
     * @param string $siteLang Язык сайта в формате ru
     * @return bool
     */
    public static function changeLang(string $siteLang): bool
    {
        $db = Db::getConnection();

        $query = "UPDATE settings SET `value` = ':lang' WHERE `option` = 'lang'";
        $result = $db->prepare($query);
        $result->bindParam(':lang', $siteLang);
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

        if ($db) {
            $query = "SELECT `value` FROM settings WHERE `option` = '$optionName'";
            $result = $db->prepare($query);
            return $result->fetch();
        }
        return 'default';
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