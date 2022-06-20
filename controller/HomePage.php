<?php
    class HomePage{
        public function __construct()
        { 
        }

        public function index(){
            echo "home page";
        }

        private $table = 'Homes';
        public function showAllHome(){ 
            require_once '../model/HomesModel.php';
            $home = new HomesModel();
            $homes = $home->getAll($this->table);  
            require_once '../views/Home/homes.php'; 
        }
    }


?>