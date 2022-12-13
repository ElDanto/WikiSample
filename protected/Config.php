<?php
namespace App;

class Config 
{
    public $data = [];

    public static $instance = null;

    protected function __construct(){
        $this->data['db'] = include __DIR__ . '/configurationDb.php';
    }
    
    public static function instance()
    {
        if(null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }


}