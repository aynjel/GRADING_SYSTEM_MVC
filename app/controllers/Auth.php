<?php

class Auth extends Controller{
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }
    
    public function admin_register(){

        if($_POST){
            
            if($_POST['password'] != $_POST['confirm_password']){
                echo 'Passwords do not match';
            }else{
                $user = new Users();
                $user->admin_register($_POST);
            }
        }

        $this->view->render('auth/admin_register');
    }

}