<?php

$env = parse_ini_file(ROOT . '/.env');
return array(
    'host' => $env['HOST'] ?: "localhost",
    'port' => $env['PORT'] ?: 3306,
    'user' => $env['USER'] ?: "root",
    'password' => $env['PASSWORD'] ?: "",
    'dbname' => $env["DBNAME"] ?: "Blooen",
);