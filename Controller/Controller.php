<?php

class Controller
{
    public function model($model)
    {
        if (file_exists('../Model/' . $model . '.php')) {
            require_once '../Model/' . $model . '.php';
            return new $model();
        } else {
            die("Model does not exists.");
        }
    }

    public function view($view, $data = [], $data2 = [])
    { 
        if(file_exists('../View/' .  $view . '.php')){  
            require_once '../View/' . $view . '.php';
        }else{
            die("View does not exists.");
        }
    }
}