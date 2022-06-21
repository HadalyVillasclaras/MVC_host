<?php
    class HomesController extends Controller{
        private $table = 'Homes';

        public function __construct(){
            $this->homeModel = $this->model('Home');
        }
        
        public function showAllHome(){ 
            $homes = $this->homeModel->getAll($this->table);  
            $this->view('Home/homes', $homes);  
        }

        function getSingleHome($id){ 
            $this->homeModel->setId($id);
            $this->homeModel->getHome();
        }

        public function SubmitHome($name, $city, $price, $img){ 
            $this->homeModel->setName($name);
            $this->homeModel->setCity($city);
            $this->homeModel->setPrice($price); 
            $this->homeModel->setImage($img);
            $this->homeModel->InsertHome(); 
        }

        public function EditHome($id,$name, $city, $price, $img){ 
            $this->homeModel->setId($id);
            $this->homeModel->setName($name);
            $this->homeModel->setCity($city);
            $this->homeModel->setPrice($price); 
            $this->homeModel->setImage($img);
            $this->homeModel->EditHome();
        }
        
        public function DeleteHome($id){ 
            $this->homeModel->DeleteHome($id);
            //header("location:".$_SERVER['HTTP_REFERER']);
        } 

    } 

?>