<?php
    class HomesController extends Controller{
        private $table = 'Homes';
        
        public function showAllHome(){ 
            $this->model('HomesModel');
            $homeModel = new HomesModel();
            $homes = $homeModel->getAll($this->table);  
            $this->view('Home/homes');  
        }

        function getSingleHome($id){
            $this->model('HomesModel');
            $homeModel = new HomesModel();
            $homeModel->setId($id);
            $homeModel->getHome();
        }

        public function SubmitHome($name, $city, $price, $img){
            $this->model('HomesModel');
            $homeModel = new HomesModel();
            $homeModel->setName($name);
            $homeModel->setCity($city);
            $homeModel->setPrice($price); 
            $homeModel->setImage($img);
            $homeModel->InsertHome(); 
        }

        public function EditHome($id,$name, $city, $price, $img){
            $this->model('HomesModel');
            $homeModel = new HomesModel();
            $homeModel->setId($id);
            $homeModel->setName($name);
            $homeModel->setCity($city);
            $homeModel->setPrice($price); 
            $homeModel->setImage($img);
            $homeModel->EditHome();
        }
        
        public function DeleteHome($id){
            $this->model('HomesModel');
            $homeModel = new HomesModel();
            $homeModel->DeleteHome($id);
            //header("location:".$_SERVER['HTTP_REFERER']);
        } 

    } 

?>