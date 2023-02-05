<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('APP', ROOT . DS . 'app');
define('VIEWS', APP . DS . 'views');
define('CONTROLLERS', APP . DS . 'controllers');
define('MODELS', APP . DS . 'models');
define('CORE', 'core');

//autoload classes
function autoload($className) {
    if (file_exists(CORE . DS . $className . '.php')) {
        require_once(CORE . DS . $className . '.php');
    } elseif (file_exists(CONTROLLERS . DS . $className . '.php')) {
        require_once(CONTROLLERS . DS . $className . '.php');
    } elseif (file_exists(MODELS . DS . $className . '.php')) {
        require_once(MODELS . DS . $className . '.php');
    } else{
        die('The file ' . $className . '.php could not be found');
    }
}

spl_autoload_register('autoload');
session_start();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

//call the router
Router::route($url);