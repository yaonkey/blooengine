<?php

use Blooengine\Models\Category;
use Blooengine\Models\Product;

/**
 * Контроллер ProductController
 * Товар
 */
class ProductController
{

    /**
     * Action для страницы просмотра товара
     * @param integer $productId <p>id товара</p>
     */
    public function actionView(int $productId): bool
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Получаем информацию о товаре
        $product = Product::getProductById($productId);

        // Подключаем вид
        require_once(THEME . 'product/view.php');
        return true;
    }

}
