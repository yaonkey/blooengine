<?php

namespace Blooengine\Models;

interface Model
{
    public static function createTable(string $db_name): bool;
    public static function getAllFromTable(): array;
}
