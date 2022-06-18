<?php
    class AdminPanelController{ 

        public function home(){
            require_once '../views/AdminPanel/AdminHome.php';  
        }
        public function homesPanel(){ 
            require_once '../model/HomesModel.php';
            $home = new HomesModel();
            $homes = $home->getAll('Homes');   
            require_once '../views/AdminPanel/HomesAdmin.php'; 

            if(isset($_GET['delete'])){
                require_once 'HomesController.php';
                $id = $_GET['delete'];
                $home = new HomesController();
                $home->DeleteHome($id);
            }

            if(isset($_GET['edit'])){
                require_once '../controller/HomesController.php';
                $id = $_GET['edit'];
                $home = new HomesController();
                $home->EditHome($id);
            }
        }
    }




?>