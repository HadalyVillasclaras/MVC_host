<?php
    class HomesController{
        private $table = 'Homes';
        public function showAllHome(){ 
            require_once '../model/HomesModel.php';
            $home = new HomesModel();
            $homes = $home->getAll($this->table);  
            require_once '../views/Home/homes.php'; 
        }

        function getSingleHome($id){
            require_once '../model/HomesModel.php';
            $home = new HomesModel();
            $home->setId($id);
            $home->getHome();
        }

        public function SubmitHome($name, $city, $price, $img){
            require_once '../model/HomesModel.php';
            $home = new HomesModel();
            $home->setName($name);
            $home->setCity($city);
            $home->setPrice($price); 
            $home->setImage($img);
            $home->InsertHome(); 
        }

        public function EditHome($id,$name, $city, $price, $img){
            require_once '../model/HomesModel.php';
            $home = new HomesModel();
            $home->setId($id);
            $home->setName($name);
            $home->setCity($city);
            $home->setPrice($price); 
            $home->setImage($img);
            $home->EditHome();
        }
        
        public function DeleteHome($id){
            require_once '../model/HomesModel.php';
            $home = new HomesModel();
            $home->DeleteHome($id);
            //header("location:".$_SERVER['HTTP_REFERER']);
        } 

    } 

?>