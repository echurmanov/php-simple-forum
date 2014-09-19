<?php

set_include_path(get_include_path() . ';' . realpath(__DIR__));


function _autoloader($className)
{
    $filePath = str_replace('_', '/', $className)  . ".php";
    require_once($filePath);
}

spl_autoload_register ("_autoloader");

$config = include __DIR__ . '/../config/config.php';




Connection::setConnection(
    Connection::createConnection(
        $config['db']['host'],
        $config['db']['user'],
        $config['db']['password'],
        $config['db']['dbname']
    )
);
View::setViewPath($config['viewPath']);


