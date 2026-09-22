<?php
declare(strict_types=1);

function database(): PDO
{
    $directory = __DIR__ . DIRECTORY_SEPARATOR . 'data';
    if (!is_dir($directory)) {
        mkdir($directory, 0775, true);
    }

    $database = new PDO('sqlite:' . $directory . DIRECTORY_SEPARATOR . 'portfolio.sqlite');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $database->exec(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'schema.sql'));

    return $database;
}
