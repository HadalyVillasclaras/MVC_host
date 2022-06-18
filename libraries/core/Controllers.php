<?php
    class Controllers{

        public function __construct(){
            $this->views = new Views();
            $this->loadModel();
        }

        //esta clase es para cargar los modelos directamente evitando asi los multiples requires.
        
        public function loadModel(){
            //HomesModel.php
            $model = get_class($this). "Model";
            $classRoute = "model/" . $model . '.php';
            if(file_exists($classRoute)){
                require_once($classRoute);
            }else{
                echo "No existe la ruta";
                $this->model = new $model();
            }
        }
    }



?>