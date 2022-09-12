<?php

class Controller
{
    public function model($model)
    {
        if (file_exists('../Model/' . $model . '.php')) {
            require_once '../Model/' . $model . '.php';
            return new $model();
        } else {
            throw new Exception('Model does not exist.');
        }
    }

    public function view($view, $data = [], $errors = [])
    { 
        if (file_exists('../View/' .  $view . '.php')) {  
            require_once '../View/' . $view . '.php';
        } else {
            throw new Exception('View does not exist.');
        }
    }
}
