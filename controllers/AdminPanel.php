<?php
    class AdminPanel extends Controller{ 
        public function home(){
            $this->view('AdminPanel/AdminHome');    
        }
        
        public function homesPanel(){ 
            require_once 'HomesController.php';
            $this->model('Home');
            $home = new Home();
            $homes = $home->getAll('Homes');   
            $this->view('AdminPanel/HomesAdmin', $homes); 
        }

        
    }




?>