<?php

namespace Blooengine\Components;

/*
 * Класс Pagination для генерации постраничной навигации
 */

class Pagination
{

    /**
     *
     * @var int Ссылок навигации на страницу
     *
     */
    private int $max = 10;

    /**
     *
     * @var string Ключ для GET, в который пишется номер страницы
     *
     */
    private string $index = "page-";

    /**
     *
     * @var int Текущая страница
     *
     */
    private int $current_page;

    /**
     *
     * @var int Общее количество записей
     *
     */
    private int $total;

    /**
     *
     * @var int Записей на страницу
     *
     */
    private int $limit;

    /**
     * Запуск необходимых данных для навигации
     * @param int $total <p>Общее количество записей</p>
     * @param int $currentPage <p>Номер текущей страницы</p>
     * @param int $limit <p>Количество записей на страницу</p>
     * @param int $index <p>Ключ для url</p>
     */
    public function __construct(int $total, int $currentPage, int $limit, string $index)
    {
        # Устанавливаем общее количество записей
        $this->total = $total;

        # Устанавливаем количество записей на страницу
        $this->limit = $limit;

        # Устанавливаем ключ в url
        $this->index = $index;

        # Устанавливаем количество страниц
        $this->amount = $this->amount();

        # Устанавливаем номер текущей страницы
        $this->setCurrentPage($currentPage);
    }

    /**
     *  Для вывода ссылок
     * @return string со ссылками навигации
     */
    public function get(): string
    {
        # Для записи ссылок
        $links = null;

        # Получаем ограничения для цикла
        $limits = $this->limits();

        $html = '<ul class="pagination">';
        # Генерируем ссылки
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # Если текущая это текущая страница, ссылки нет и добавляется класс active
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                # Иначе генерируем ссылку
                $links .= $this->generateHtml($page);
            }
        }

        # Если ссылки создались
        if (!is_null($links)) {
            # Если текущая страница не первая
            if ($this->current_page > 1)
                # Создаём ссылку "На первую"
                $links = $this->generateHtml(1, '&lt;&lt;') . $links;

            # Если текущая страница не первая
            if ($this->current_page < $this->amount)
                # Создаём ссылку "На последнюю"
                $links .= $this->generateHtml($this->amount, '&gt;&gt;');
        }

        $html .= $links . '</ul>';

        # Возвращаем html
        return $html;
    }

    /**
     * Для генерации HTML-кода ссылки
     * @param integer $page - номер страницы
     * @param null $text
     * @return string
     */
    private function generateHtml(int $page, $text = null): string
    {
        # Если текст ссылки не указан
        if (!$text)
            # Указываем, что текст - цифра страницы
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        # Формируем HTML код ссылки и возвращаем
        return
            '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     *  Для получения, откуда стартовать
     *
     * @return array С началом и концом отсчёта
     */
    private function limits(): array
    {
        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
        $left = $this->current_page - round($this->max / 2);

        # Вычисляем начало отсчёта
        $start = $left > 0 ? $left : 1;

        # Если впереди есть как минимум $this->max страниц
        if ($start + $this->max <= $this->amount) {
            # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            # Конец - общее количество страниц
            $end = $this->amount;

            # Начало - минус $this->max от конца
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        # Возвращаем
        return array($start, $end);
    }

    /**
     * Для установки текущей страницы
     *
     * @param int $currentPage
     * @return void
     */
    private function setCurrentPage(int $currentPage): void
    {
        # Получаем номер страницы
        $this->current_page = $currentPage;

        # Если текущая страница больше нуля
        if ($this->current_page > 0) {
            # Если текущая страница меньше общего количества страниц
            if ($this->current_page > $this->amount)
                # Устанавливаем страницу на последнюю
                $this->current_page = $this->amount;
        } else
            # Устанавливаем страницу на первую
            $this->current_page = 1;
    }

    /**
     * Для получения общего числа страниц
     *
     * @return float страниц
     */
    private function amount(): float
    {
        # Делим и возвращаем
        return ceil($this->total / $this->limit);
    }
}
