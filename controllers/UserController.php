<?php

use Blooengine\Models\User;

/**
 * Контроллер UserController
 */
class UserController
{
    /**
     * Action для страницы "Регистрация"
     */
    public function actionRegister(): bool
    {
        // Переменные для формы
        $name = false;
        $password = false;
        $result = false;
        $email = false;

        // Обработка формы

        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkName($name)) {
                $errors = ['Имя не должно быть короче 2-х символов'];
            }
            if (!User::checkEmail($email)) {
                $errors = ['Неправильный email'];
            }
            if (!User::checkPassword($password)) {
                $errors = ['Пароль не должен быть короче 6-ти символов'];
            }
            if (User::checkEmailExists($email)) {
                $errors = ['Такой email уже используется'];
            }

            if (!$errors) {
                //$password = password_hash($password, PASSWORD_DEFAULT);
                // Если ошибок нет
                // Регистрируем пользователя
                $result = User::register($name, $email, $password);
                if (strlen($result) == 0) {
                    header("Location: /");
                }
            }
        }

        // Подключаем вид
        require_once(THEME . 'user/register.php');
        return true;
    }

    /**
     * Action для страницы "Вход на сайт"
     */
    public function actionLogin(): bool
    {
        // Переменные для формы
        $email = false;
        $password = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkEmail($email)) {
                $errors = ['Неправильный email'];
            }
            if (!User::checkPassword($password)) {
                $errors = ['Пароль не должен быть короче 6-ти символов'];
            }

            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);

            if (!$userId) {
                // Если данные неправильные - показываем ошибку
                $errors = ['Неправильные данные для входа на сайт'];
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);

                // Перенаправляем пользователя в закрытую часть - кабинет
                //header("Location: /cabinet");
                header("Location: /");
            }
        }

        // Подключаем вид
        require_once(THEME . 'user/login.php');
        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout(): void
    {
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);

        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }
}
