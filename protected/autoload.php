<?php 
spl_autoload_register(function ($class) {
    $tempClass = substr($class, 4);
    // $result = __DIR__ . '/protected/' . str_replace('\\', '/', $tempClass) . '.php';
    $result = __DIR__ . '/' . str_replace('\\', '/', $tempClass) . '.php';
    require $result;
});