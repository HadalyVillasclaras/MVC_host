<?php

class Controller
{
    public function __construct(){
    } 

    public function model($model)
    {
        if(file_exists('../models/' . $model . '.php')) {
            require_once '../models/' . $model . '.php';
            return new $model();
        } else {
            die("Model does not exists.");
        }
    }

    public function view($view, $data = [])
    { 
        if(file_exists('../views/' .  $view . '.php')){  
            require_once '../views/' . $view . '.php';
        }else{
            die("View does not exists.");
        }
    }
}