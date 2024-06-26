<?php

use Blooengine\Components\AdminBase;
use Blooengine\Models\Category;

/**
 * Контроллер AdminCategoryController
 * Управление категориями товаров в админпанели
 */
class AdminCategoryController extends AdminBase
{

    /**
     * Action для страницы "Управление заголовками"
     */
    public function actionCreateHeader(): bool
    {
        self::checkAdmin();

        require_once(THEME . 'admin_category/createHeader.php');
        return true;
    }

    /**
     * Action для страницы "Управление категориями"
     */
    public function actionIndex(): bool
    {
        // Проверка доступа
        self::checkAdmin();

        $searchError = false;
        if (!empty($_POST['query1'])) {
            $categoriesList = Category::getCategoriesListAdminByName($_POST['query1']);
        } else {
            $categoriesList = Category::getCategoriesListAdmin();
        }

        // Получаем список категорий
        $categoriesList = Category::getCategoriesListAdmin();

        // Подключаем вид
        require_once(THEME . 'admin_category/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function actionCreate(): bool
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
            $type = $_POST['type'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (empty($name)) {
                $errors = ['Заполните поля'];
            }


            if (!$errors) {
                // Если ошибок нет
                // Добавляем новую категорию
                Category::createCategory($name, $sortOrder, $status, $type);

                // Перенаправляем пользователя на страницу управлениями категориями
                header("Location: /admin/category");
            }
        }

        require_once(THEME . 'admin_category/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать категорию"
     */
    public function actionUpdate(int $id): bool
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретной категории
        $category = Category::getCategoryById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
            $type = $_POST['type'];

            // Сохраняем изменения
            Category::updateCategoryById($id, $name, $sortOrder, $status, $type);

            // Перенаправляем пользователя на страницу управлениями категориями
            header("Location: /admin/category");
        }

        // Подключаем вид
        require_once(THEME . 'admin_category/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить категорию"
     */
    public function actionDelete(int $id): bool
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем категорию
            Category::deleteCategoryById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/category");
        }

        // Подключаем вид
        require_once(THEME . 'admin_category/delete.php');
        return true;
    }
}
