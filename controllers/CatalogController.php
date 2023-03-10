<?php

use Blooengine\Components\Pagination;
use Blooengine\Models\Category;
use Blooengine\Models\Product;

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class CatalogController
{

    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex($page = 1): bool
    {
        $searchError = false;
        $categories = Category::getCategoriesList();
        if (!empty($_POST['query'])) {
            $latestProducts = Product::search($_POST['query']);
        } else {
            $latestProducts = Product::getLatestProducts($page, Product::SHOW_BY_DEFAULT);
        }


        $total = Category::getTotalPages();
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action для страницы "Категория товаров"
     */
    public function actionCategory($categoryId, $page = 1): bool
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();
        // Список товаров в категории
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProductsInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
