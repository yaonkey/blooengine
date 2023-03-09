<?php

namespace Blooengine\Components;
enum Methods
{
    case UPDATE;
    case DELETE;
    case INSERT;
    case SELECT;
}

/**
 * Компонент для миграций
 */
class Migrator
{
    public static function prepare(string $query, Methods $method)
    {

    }

}