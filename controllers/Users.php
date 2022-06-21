<?php

class UsersController extends Controller{
    public function index(){
        echo "Clase UsersController, función index()";
    }
 
    public function signUp(){
        $this->view('User/signup');  
    }

    public function saveUser(){

    }
} 

?>