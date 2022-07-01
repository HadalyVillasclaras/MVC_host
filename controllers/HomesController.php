<?php
    class HomesController extends Controller{ 
         public $table = 'Homes';
        public function __construct(){
            $this->homeModel = $this->model('Home');
            require_once '../libraries/image.php';
            $this->imageClass = new Image();
        }
        
        public function allHomes(){ 
            $homes = $this->homeModel->getAll($this->table);   
            $this->view('Home/homes', $homes);  
        }
 

        public function home(){ //single page home 
            $id = $_GET['id'];
            $this->homeModel->id = $id;
            $home = $this->homeModel->getSingleRow();
            $data = [ 
                'homeId' => $home['Id'],
                'Name' => $home['Name'],
                'Price' => $home['Price'],
                'ImageFolder' => $home['ImageFolder'],
                'ImageName' => $home['ImageName'],
                'startDate' => '',
                'endDate' => '',
                'guests' => '',
                'errorFeedback' => '', 
                'reservationFeedback' => '',
                'availableHome' => false
            ]; 
            $this->view('Home/singleHome', $data);  
        }


        public function SubmitHome(){ 
            if(!isLoggedIn()){
                header("Location: " . BASE_URL . 'userscontroller/login');
            }
 
            $data = [
                //añadir id para ver quien ha hecho el submit $_SESSION['id']
                'imgPath' => '',
                'nameError' => '',
                'cityError' => '',
                'imgError' => '',
                'submitFeedback' => ''
            ];

            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); //sanitize

                if(isset($_POST['submit'])){ 
                    $name = trim($_POST['name']);
                    $city = trim($_POST['city']);
                    $price = trim($_POST['price']);
                    $img = $_FILES['image'];
                    $imgFolder = $this->imageClass->imgFolderName($name);

                    if(empty($name)){
                        $data['nameError'] = 'Field must be filled';
                    }
                    if(empty($city)){
                        $data['cityError'] = 'Field must be filled';
                    } 
                    if(empty($img)){
                        $data['imgError'] = 'Field must be filled';
                    }

                    //Check and submit Home
                    if(empty($data['nameError']) && empty($data['cityError']) && empty($data['imgError'])){
                 
                        $imgName = $this->imageClass->checkImage($img, $name);  
                        if($imgName){ 
                            $this->homeModel->img = $imgName; 
                            $this->homeModel->imgFolder = $imgFolder; 
                            $this->homeModel->name = $name;
                            $this->homeModel->city = $city;
                            $this->homeModel->price = $price; 
 
                            $this->homeModel->InsertHome(); 
                        }else{
                            echo "error en img";
                        }
                        
                    }else{
                        $this->view('Admin/UploadHome', $data);
                    } 
                }
            }
            $this->view('Admin/UploadHome', $data);
        }

 
        public function EditHome(){ 
            if(!isLoggedIn()){
                header("Location: " . BASE_URL . 'userscontroller/login');
            }

            $homes = $this->homeModel->getAll($this->table);   

            $this->view('Admin/HomesAdmin', $homes); 

            if(isset($_GET['edit'])){
                $id = $_GET['edit'];

                $this->homeModel->id = $id;
                $homeToEdit = $this->homeModel->getSingleRow();  
                $this->view('Admin/EditHomeForm', $homeToEdit); 

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); //sanitize
                    if(isset($_POST['submit'])){
                        $name=$_POST['name'];
                        $city=$_POST['city'];
                        $price=$_POST['price'];
                        $img=$_FILES['image']; 
    
                        $this->homeModel->name = $name;
                        $this->homeModel->city = $city;
                        $this->homeModel->price = $price; 
                        $this->homeModel->img = $img;  

                        $this->homeModel->EditHome(); 
                        header('Location: '.$_SERVER['HTTP_REFERER']);
                        $this->view('Admin/EditHomeForm', $homeToEdit); 
                        
                    } 
                }
            }


            
        }
        

        public function DeleteHome(){ 
            if(!isLoggedIn()){
                header("Location: " . BASE_URL . 'userscontroller/login');
            }

            if(isset($_GET['delete'])){
                $this->view('Admin/DeleteMsg');   
                $id = $_GET['delete'];  
                $this->homeModel->id = $id;
                $this->homeModel->DeleteHome();
                header("location:".$_SERVER['HTTP_REFERER']);
            }
        } 



        


        



    } 

?>