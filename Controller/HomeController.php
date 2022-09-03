<?php

class HomeController extends Controller
{     
    public $table = 'Homes';
    
    public function __construct()
    {
        $this->homeModel = $this->model('Home');
    }
    
    public function getAllHomes()
    { 
        $allHomes = $this->homeModel->getAll($this->table);   
        $this->view('Home/homes', $allHomes);  
    }


    public function home() //single page home 
    { 
        $id = $_GET['id'];
        $this->homeModel->id = $id;

        $home = $this->homeModel->getSingleRow();

        $data = [ 
            'homeId' => $home['id'],
            'Name' => $home['name'],
            'Price' => $home['price'],
            'ImageFolder' => $home['image_folder'],
            'ImageName' => $home['image_name'],
            'startDate' => '',
            'endDate' => '',
            'guests' => '',
            'errorFeedback' => '', 
            'reservationFeedback' => '',
            'availableHome' => false
        ]; 
        $this->view('Home/singleHome', $data);  
    }


    public function addHome()
    { 
        if (!isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        require_once '../libraries/image.php';
        $this->imageClass = new Image();

        $data = [
            'imgPath' => '',
            'nameError' => '',
            'cityError' => '',
            'imgError' => '',
            'submitFeedback' => ''
        ];

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); //sanitize

            if (isset($_POST['submit'])) { 

                $name = trim($_POST['name']);
                $city = trim($_POST['city']);
                $price = trim($_POST['price']);
                $img = $_FILES['image'];
                $imgFolder = $this->imageClass->imgFolderName($name);

                if (empty($name)) {
                    $data['nameError'] = 'Field must be filled';
                }
                if (empty($city)) {
                    $data['cityError'] = 'Field must be filled';
                } 
                if (empty($img)) {
                    $data['imgError'] = 'Field must be filled';
                }

                $imgName = $this->imageClass->checkImage($img, $name);  //meter error en img msg

                //Check and submit Home
                if (
                    empty($data['nameError']) && 
                    empty($data['cityError']) && 
                    empty($data['imgError']) &&
                    $imgName == true
                    ){
                        
                    $this->homeModel->img = $imgName; 
                    $this->homeModel->imgFolder = $imgFolder; 
                    $this->homeModel->name = $name;
                    $this->homeModel->city = $city;
                    $this->homeModel->price = $price; 

                    $this->homeModel->InsertHome(); 
                    
                }else{
                    $this->view('Users/AdminPanel/AddHomeForm', $data);
                } 
            }
        }
        $this->view('Users/AdminPanel/AddHomeForm', $data);
    }


    public function editHome()
    { 
        if (!isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        $homes = $this->homeModel->getAll($this->table);   

        $this->view('Users/AdminPanel/Homes', $homes); 

        if(isset($_GET['edit'])){
            $this->homeModel->id = $_GET['edit'];

            $homeToEdit = $this->homeModel->getSingleRow();  

            $this->view('Users/AdminPanel/EditHomeForm', $homeToEdit); 

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

                    $this->homeModel->editHome(); 

                    header('Location: '.$_SERVER['HTTP_REFERER']);
                    $this->view('Users/AdminPanel/EditHomeForm', $homeToEdit); 
                } 
            }
        }
    }
    
    public function deleteHome()
    { 
        $deleteConfirmation = false;
        if (!isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        //background view
        $homes = $this->homeModel->getAll($this->table);   
        $this->view('Users/AdminPanel/Homes', $homes); 

        if (isset($_GET['delete'])) {
            $this->view('Users/AdminPanel/DeleteConfirmationMsg');   

            if (isset($_POST['delete'])) {
                $this->homeModel->id = $_GET['delete'];
                $homeToDelete = $this->homeModel->getSingleRow();  
                $this->homeModel->deleteHome();

                header("location:".$_SERVER['HTTP_REFERER']);
            } 
        }
    } 
} 
