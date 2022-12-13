<?php
namespace App;

use App\View;

abstract class Controller 
{
    protected $view;
    protected $actionName = 'Default';

    public function __construct()
    {
        $this->view = new View;

        $this->action($this->actionName);
    }

    public function access($action)
    {
        return true;
    }

    public function action(string $actionName)
    {
        if ($this->access($actionName)) {
            $methodName = 'action' . $actionName;
            $this->$methodName();
        } else {
            die('Доступ запрещен!');
        }
    }
}
