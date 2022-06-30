<?php
    class AdminPanel extends Controller{ 
        public function home(){
            if(!isLoggedIn()){
                header("Location: " . BASE_URL . 'userscontroller/login');
            }
            require_once 'HomesController.php';
            $this->model('Home');
            $home = new Home();
            $homes = $home->getAll('Homes');   
            $this->view('AdminPanel/HomesAdmin', $homes); 
        }
        
         

        
    }




?>