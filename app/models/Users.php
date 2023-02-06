<?php

//users model
class Users extends Model{
    public $id, $username, $password, $email, $first_name, $last_name, $contact_number, $address;

    public function __construct(){
        $table = 'users';
        parent::__construct($table);
    }

    public function admin_register($params){
        $this->insert($params);
    }

    public function admin_login($params){
        $user = $this->findFirst([
            'conditions' => "username = ?",
            'bind' => [$params['username']]
        ]);
        if($user){
            if(password_verify($params['password'], $user->password)){
                return $user;
            }
        }
        return false;
    }
}