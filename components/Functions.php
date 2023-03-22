<?php

namespace Blooengine\Components;

class Functions
{
    /** Проверка существования .lock-файла
     * @return bool
     */
    public static function isLock(): bool
    {
        return file_exists(ROOT . "/.lock");
    }

    /** Создание и запись в .lock-файл значения
     * @param string $value
     * @return void
     */
    public static function inputLock(string $value = '')
    {
        file_put_contents(ROOT . "/.lock", $value, FILE_APPEND | LOCK_EX);
    }


    public static function getLock(): bool|int
    {
        return readfile(ROOT . "/.lock");
    }
}
