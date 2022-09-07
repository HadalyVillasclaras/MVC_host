<?php

class Controller
{
    public function __construct(){
    } 

    public function model($model)
    {
        if(file_exists('../model/' . $model . '.php')) {
            require_once '../model/' . $model . '.php';
            return new $model();
        } else {
            die("Model does not exists.");
        }
    }

    public function view($view, $data = [])
    { 
        if(file_exists('../view/' .  $view . '.php')){  
            require_once '../view/' . $view . '.php';
        }else{
            die("View does not exists.");
        }
    }
}