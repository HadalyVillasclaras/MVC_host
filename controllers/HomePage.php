<?php
    class HomePage extends Controller{ //controllers class
        public function __construct(){ 
        }
        private $table = 'Homes';

        public function index(){
            $data = [
                'title' => 'Home page'
            ];
            
            $this->view('HomePage/cabecera');
            $this->model('Home'); 
            $home = new Home();
            $homes = $home->getAll($this->table);  
            $this->view('Home/homes', $homes); //la vista es diferente a homesController/showAllHome
        }
    }


?>