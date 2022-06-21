<?php
    class HomePage extends Controller{ //controllers class
        public function __construct()
        { 
        }
        private $table = 'Homes';

        public function index(){
            $this->view('HomePage/cabecera');

            $this->model('HomesModel'); 
            $home = new HomesModel();
            $homes = $home->getAll($this->table);  
            $this->view('Home/homes', $homes); //la vista es diferente a homesController/showAllHome
        }
    }


?>