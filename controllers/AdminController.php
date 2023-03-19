<?php

use Blooengine\Components\AdminBase;

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionIndex(): bool
    {
        // Проверка доступа
        self::checkAdmin();

        // Подключаем вид
        require_once(THEME . 'admin/index.php');
        return true;
    }

}
