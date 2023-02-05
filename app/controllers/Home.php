<?php

class Home extends Controller {
    
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }
    
    public function index() {
        $data = [
            'title' => 'Welcome to the home page',
            'description' => 'This is the home page of the website'
        ];

        $this->view->render('home/index', $data);
    }
}