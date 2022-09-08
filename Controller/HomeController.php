<?php

class HomeController extends Controller
{     
    private $homeModel;
    
    public function __construct()
    {
        $this->homeModel = $this->model('Home');
    }
    
    public function getAllHomes() //Destinations page
    { 
        $allHomes = $this->homeModel->getAll();   
        $this->view('Home/homes', $allHomes);  
    }


    public function homeSinglePage() //Single page home 
    { 
        $this->homeModel->id = $_GET['id'];

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
        require_once '../libraries/session.php';
        require_once '../libraries/Image.php';

        $isLoggedIn = new Session();
        if (!$isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }


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
                $homeName = trim($_POST['name']);
                $city = trim($_POST['city']);
                $price = trim($_POST['price']);
                $img = $_FILES['image'];

                if (empty($homeName)) {
                    $data['nameError'] = 'Field must be filled';
                }
                if (empty($city)) {
                    $data['cityError'] = 'Field must be filled';
                } 
                if (empty($img)) {
                    $data['imgError'] = 'Field must be filled';
                }

                $image = new Image($img, $homeName);
                $image->saveImage();

                $newImgName = $image->newFileName;
                $imgFolderName = $image->imgFolderName;

                


                //Check and submit Home
                if (
                    empty($data['nameError']) && 
                    empty($data['cityError']) && 
                    empty($data['imgError'])
                    ){
                        $this->homeModel->img = $newImgName;  
                        $this->homeModel->imgFolderName = $imgFolderName;  
                        $this->homeModel->name = $homeName;
                        $this->homeModel->city = $city;
                        $this->homeModel->price = $price; 

                        $this->homeModel->addHome(); 
                    
                }else{
                    $this->view('Users/AdminPanel/AddHomeForm', $data);
                } 
            }
        }
        $this->view('Users/AdminPanel/AddHomeForm', $data);
    }


    public function updateHome()
    { 
        $isLoggedIn = new Session();

        if (!$isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        $homes = $this->homeModel->getAll();   

        $this->view('Users/AdminPanel/Homes', $homes); 

        if(isset($_GET['edit'])){
            $this->homeModel->id = $_GET['edit'];
            $homeToUpdate = $this->homeModel->getSingleRow();   

            $this->view('Users/AdminPanel/updateHomeForm', $homeToUpdate); 
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); //sanitize
                
                if (isset($_POST['submit'])){
                    $name=$_POST['name'];
                    $city=$_POST['city'];
                    $price=$_POST['price'];
                    $img=$_FILES['image']; 

                    $this->homeModel->name = $name;
                    $this->homeModel->city = $city;
                    $this->homeModel->price = $price; 
                    $this->homeModel->img = $img;  

                    $this->homeModel->updateHome(); 

                    header('Location: '.$_SERVER['HTTP_REFERER']);
                    $this->view('Users/AdminPanel/updateHomeForm', $homeToUpdate); 
                } 
            }
        }
    }
    
    public function deleteHome()
    { 
        $deleteConfirmation = false;
        $isLoggedIn = new Session();

        if (!$isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        //background view
        $homes = $this->homeModel->getAll();   
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
