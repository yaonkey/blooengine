<?php

use Blooengine\Models\Category;
use Blooengine\Models\Product;
use Blooengine\Models\User;

/**
 * Контроллер CartController
 */
class SiteController
{
    //    private $

    /**
     * Action для главной страницы
     */
    public function actionIndex(): bool
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список последних товаров
        $latestProducts = Product::getNewProducts(6);

        // Список товаров для слайдера
        $sliderProducts = Product::getRecommendedProducts();

        // Подключаем вид
        require_once(THEME . 'site/index.php');
        return true;
    }

    /**
     * Action для страницы "Контакты"
     */
    public function actionContact(): bool
    {

        // Переменные для формы
        $userEmail = false;
        $userText = false;
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors = ['Неправильный email'];
            }

            if (!$errors) {
                // Если ошибок нет
                // Отправляем письмо администратору
                $adminEmail = 'thesuperuserstyle@gmail.com';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        // Подключаем вид
        require_once(THEME . 'site/contact.php');
        return true;
    }

    /**
     * Action для страницы "О магазине"
     */
    public function actionAbout(): bool
    {
        // Подключаем вид
        require_once(THEME . 'site/about.php');
        return true;
    }
}
