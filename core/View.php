<?php

class View{
    protected $_head, $_body, $_siteTitle = Config::SITE_TITLE, $_outputBuffer, $_layout = Config::DEFAULT_LAYOUT, $css, $js;
    public $displayErrors;

    public function __construct(){}

    public function render($viewName, $data = []){
        $viewAry = explode('/', $viewName);
        $viewString = implode(DS, $viewAry);
        if(file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php')){
            require_once(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php');
            require_once(ROOT . DS . 'app' . DS . 'views' . DS . 'layout' . DS . $this->_layout . '.php');
        } else {
            die('The view \"' . $viewName . '\" does not exist.');
            // require_once(ROOT . DS . 'app' . DS . 'views' . DS . 'errors' . DS . '404.php');
        }
    }

    public function content($type){
        if($type == 'head'){
            return $this->_head;
        } elseif($type == 'body'){
            return $this->_body;
        }
        return false;
    }

    public function start($type){
        $this->_outputBuffer = $type;
        ob_start();
    }

    public function end(){
        if($this->_outputBuffer == 'head'){
            $this->_head = ob_get_clean();
        } elseif($this->_outputBuffer == 'body'){
            $this->_body = ob_get_clean();
        } else {
            die('You must first run the start method.');
        }
    }

    public function siteTitle(){
        return $this->_siteTitle;
    }

    public function setSiteTitle($title){
        $this->_siteTitle = $title . ' | ' . Config::SITE_TITLE;
    }

    public function setLayout($path){
        $this->_layout = $path;
    }

    public function assets($path){
        return Config::PROJECT_ROOT . 'public/' . $path;
    }

    public function css($path){
        return $this->css .= '<link rel="stylesheet" href="' . $this->assets('css/' . $path) . '">';
    }

    public function js($path){
        return $this->js .= '<script src="' . $this->assets('js/' . $path) . '"></script>';
    }

    public function favicon($path){
        return '<link rel="icon" href="' . $this->assets('images/' . $path) . '">';
    }

    public function img($path){
        return $this->assets('images/' . $path);
    }

    public function displayErrors(){
        return $this->displayErrors;
    }

    public function setFormErrors($errors){
        $this->displayErrors = $errors;
    }
}