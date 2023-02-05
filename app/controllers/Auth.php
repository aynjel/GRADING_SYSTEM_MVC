<?php

class Auth extends Controller{

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }
    
    public function admin_register(){

        if($_POST){
            // Helper::debug($_POST);
        }

        $this->view->render('auth/admin_register');
    }

}