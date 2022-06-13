<?php

class UsersController{
    public function index(){
        echo "Clase UsersController, función index()";
    }
 
    public function signUp(){
        require_once 'views/User/signup.php';
    }

    public function saveUser(){

    }
} 

?>