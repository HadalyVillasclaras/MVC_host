<?php

class Router 
{
    protected $currentController = 'IndexController';
    protected $currentMethod = 'index';
    protected $params = []; 

    public function __construct()
    {    
        $url = $this->getUrl();

        // Class
        if (isset($url)) {
            if (file_exists('../controller/' . ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
            } else {
                echo 'Class does not exist.';
            }
        }

        require_once '../Controller/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        // Method
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            } else {
                echo 'Method does not exists.';
            }
        }

        // Params
        $this->params = $url ? array_values($url) : [];


        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}