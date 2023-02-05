<?php

class Controller extends Application
{
    protected $controller, $action;
    public $view;
    public $displayErrors = [];

    public function __construct($controller, $action)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->action = $action;
        $this->view = new View();
    }

    public function loadModel($model)
    {
        if (class_exists($model)) {
            $this->{$model . 'Model'} = new $model(strtolower($model));
        }
    }
}