<?php 
ini_set('display_errors', '1');ini_set('display_startup_errors', '1');error_reporting(E_ALL);
require __DIR__ . '/../protected/autoload.php';

use App\Controllers\Main;
use App\Controllers\Handler;

if( !empty ($_POST) ){
    if ( isset ( $_POST['action'] ) && isset ( $_POST['data'] ) ) {
        $handler = new Handler($_POST);
    }
};

$controller = new Main();