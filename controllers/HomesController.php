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

        public function SubmitHome(){ 
            $this->view('AdminPanel/UploadHome'); 
            if(isset($_POST['submit'])){ 
                $name=$_POST['name'];
                $city=$_POST['city'];
                $price=$_POST['price'];
                $img=$_FILES['image'];

                $this->homeModel->setName($name);
                $this->homeModel->setCity($city);
                $this->homeModel->setPrice($price); 
                $this->homeModel->setImage($img);
                $this->homeModel->InsertHome(); 
            }
            
        }

        public function EditHome(){  
            $homes = $this->homeModel->getAll('Homes');   

            $this->view('AdminPanel/HomesAdmin', $homes); 
            if(isset($_GET['edit'])){
                $id = $_GET['edit'];

                $this->homeModel->setId($id);
                $homeToEdit = $this->homeModel->getHome();  
                $this->view('AdminPanel/EditHomeForm', $homeToEdit); 

                if(isset($_POST['submit'])){
                    $name=$_POST['name'];
                    $city=$_POST['city'];
                    $price=$_POST['price'];
                    $img=$_FILES['image']; 
                     
                    $this->homeModel->setName($name);
                    $this->homeModel->setCity($city);
                    $this->homeModel->setPrice($price); 
                    $this->homeModel->setImage($img);
                    $this->homeModel->EditHome();
                } 
            }


            
        }
        
        public function DeleteHome(){ 

            if(isset($_GET['delete'])){
                $this->view('AdminPanel/DeleteMsg');   
                $id = $_GET['delete'];  
                $this->homeModel->DeleteHome($id);
                header("location:".$_SERVER['HTTP_REFERER']);
            }
            
        } 





        /*Admin Home-Management*/

        





    } 

?>