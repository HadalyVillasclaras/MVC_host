<?php
    class HomesController{
        private $table = 'Homes';

        public function showAllHome(){ 
            require_once '../model/homes.php';

            $home = new HomesModel();
            $homes = $home->getAll($this->table);  
 
            require_once '../views/Home/homes.php'; 
        }

 
        public function showAllMgmt(){ 
            require_once '../model/homes.php';

            $home = new HomesModel();
            $homes = $home->getAll($this->table);   
            require_once '../views/panel-admin/home-mgmt.php'; 
        }


        public function SubmitHome($name, $city, $price){
            require_once '../model/homes.php';
            $home = new HomesModel();
            $home->setName($name);
            $home->setCity($city);
            $home->setPrice($price); 
            $home->InsertHome(); 
        }

        public function EditHome($name, $city, $price){
            require_once '../model/homes.php';
            $home = new HomesModel();
            $home->setName($name);
            $home->setCity($city);
            $home->setPrice($price); 
            $home->EditHome();
        }
        
        public function DeleteHome($id){
            require_once '../model/homes.php';
            $home = new HomesModel();
            $home->setPrice($id);
            $home->DeleteHome();
            header("location:".$_SERVER['HTTP_REFERER']);
        } 

    } 

?>