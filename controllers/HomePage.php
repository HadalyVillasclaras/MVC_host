<?php
    class HomePage extends Controller{ //controllers class
        public function __construct()
        { 
        }

        public function index(){
            echo "home page";
        }

        private $table = 'Homes';
        public function showAllHome(){ 
            $this->model('HomesModel'); 
            $home = new HomesModel();
            $homes = $home->getAll($this->table);  
            $this->view('Home/homes', $homes);
        }
    }


?>