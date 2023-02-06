<?php

class Router{
    public static function route($url){
        //controller
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : Config::DEFAULT_CONTROLLER;
        $controller_name = $controller;
        array_shift($url);

        //action
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] : Config::DEFAULT_ACTION;
        $action_name = $controller;
        array_shift($url);
        
        //params
        $queryParams = $url;

        //dispatch
        $dispatch = new $controller($controller_name, $action);

        if(method_exists($controller, $action)){
            call_user_func_array([$dispatch, $action], $queryParams);
        }else{
            die('That method does not exist in the controller \"'.$controller_name.'\"');
        }
    }

    public static function redirect($location){
        if(!headers_sent()){
            header('Location: '.Config::PROJECT_ROOT.$location);
            exit;
        }else{
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.Config::PROJECT_ROOT.$location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
            echo '</noscript>'; exit;
        }
    }

    public static function getFormErrors(){
        if(isset($_SESSION['form_errors'])){
            $errors = $_SESSION['form_errors'];
            unset($_SESSION['form_errors']);
            return $errors;
        }
    }
}