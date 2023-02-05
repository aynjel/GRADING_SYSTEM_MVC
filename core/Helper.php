<?php

class Helper{
    public static function debug($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public static function sanitize($data){
        return htmlentities($data, ENT_QUOTES, 'UTF-8');
    }

    public static function get($key){
        if(isset($_GET[$key])){
            return self::sanitize($_GET[$key]);
        }
        return '';
    }

    public static function post($key){
        if(isset($_POST[$key])){
            return self::sanitize($_POST[$key]);
        }
        return '';
    }

    public static function old($key){
        if(isset($_POST[$key])){
            return $_POST[$key];
        }
        return '';
    }

    public static function escape($data){
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}