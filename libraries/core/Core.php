<?php

    class Core {
        protected $currentController = 'HomePage';
        protected $currentMethod = 'showAllHome';
        protected $params = []; 

        public function __construct(){      
            $url = $this->getUrl();
            print_r($url);

            //controller class
            if(file_exists('../controller/' . ucwords($url[0]) . '.php')){
                $this->currentController = ucwords($url[0]);
            }
            require_once '../controller/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;
            
            //method class
            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //params- comprueba si existe paramas, y si no lo mantiendene empty
            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        
        
        
        
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');

                $url = filter_var($url, FILTER_SANITIZE_URL);
            
                $url = explode('/', $url);

                 
                return $url;
            }
        }
    }