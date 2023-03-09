<?php

return array(
    'host' => getenv('HOST') ?: "localhost",
    'port' => getenv('PORT') ?: 3306,
    'user' => getenv('USER') ?: "root",
    'password' => getenv('PASSWORD') ?: "",
    'dbname' => getenv("DBNAME") ?: "Blooen",
);