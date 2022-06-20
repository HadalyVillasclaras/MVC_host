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
                require_once '../views/AdminPanel/DeleteMsg.php'; 

                require_once 'HomesController.php';
                $id = $_GET['delete'];
                $home = new HomesController();
                $home->DeleteHome($id);
            }

            if(isset($_GET['edit'])){
                $id = $_GET['edit'];
                require_once '../model/HomesModel.php';
                $home = new HomesModel();
                $home -> setId($id);
                $homeToEdit = $home->getHome(); 
                require_once '../views/AdminPanel/EditHomeForm.php'; 


                if(isset($_POST['submit'])){
                    $name=$_POST['name'];
                    $city=$_POST['city'];
                    $price=$_POST['price'];
                    $img=$_FILES['image'];
                    require_once '../controller/HomesController.php';
                    $home = new HomesController();
                    $home->EditHome($id,$name, $city, $price, $img);
                    header("location:".$_SERVER['HTTP_REFERER']);
                }

                
                
            }
        }

        public function submitHomeForm(){
            require_once '../views/AdminPanel/UploadHome.php';
            if(isset($_POST['submit'])){ 
                $name=$_POST['name'];
                $city=$_POST['city'];
                $price=$_POST['price'];
                $img=$_FILES['image'];
        
                require_once 'HomesController.php';
                $homes = new HomesController();
                $homes->SubmitHome($name, $city, $price, $img);
            } 

        }



    }




?>