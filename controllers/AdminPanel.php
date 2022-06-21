<?php
    class AdminPanel extends Controller{ 
        public function home(){
            $this->view('AdminPanel/AdminHome');    
        }
        
        public function homesPanel(){ 
            require_once 'HomesController.php';
            $homeController = new HomesController();

            $this->model('Home');
            $home = new Home();
            $homes = $home->getAll('Homes');   

            $this->view('AdminPanel/HomesAdmin', $homes); 

            if(isset($_GET['delete'])){
                $this->view('AdminPanel/DeleteMsg');  
                
                $id = $_GET['delete'];
                $homeController->DeleteHome($id);
            }

            if(isset($_GET['edit'])){
                $id = $_GET['edit'];
                $home -> setId($id);
                $homeToEdit = $home->getHome();  
                $this->view('AdminPanel/EditHomeForm', $homeToEdit); 

                if(isset($_POST['submit'])){
                    $name=$_POST['name'];
                    $city=$_POST['city'];
                    $price=$_POST['price'];
                    $img=$_FILES['image']; 
                    $homeController->EditHome($id,$name, $city, $price, $img);
                } 
            }
        }

        public function submitHomeForm(){
            $this->view('AdminPanel/UploadHome'); 

            if(isset($_POST['submit'])){ 
                $name=$_POST['name'];
                $city=$_POST['city'];
                $price=$_POST['price'];
                $img=$_FILES['image'];
        
                require_once 'HomesController.php';
                $homeController = new HomesController();
                $homeController->SubmitHome($name, $city, $price, $img);
            } 
        }
    }




?>