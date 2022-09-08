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
        require_once '../libraries/formsValidation.php';

        $isLoggedIn = new Session();
        if (!$isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        if (isset($_POST['submit'])) { 
            $data['homeName'] = trim($_POST['name']) ?? '';
            $data['city'] = trim($_POST['city']);
            $data['price'] = trim($_POST['price']);
            $data['img'] = $_FILES['image'];

            $image = new Image($data['img'], $data['homeName']);
            $image->saveImage();
            $data['newImgName'] = $image->newFileName;
            $data['imgFolderName'] = $image->imgFolderName;

            $validations = new FormsValidation();
            $errors = $validations->validateHomeFields($data);
            
            if (count($errors) === 0) {
                    $this->homeModel->img = $data['newImgName'];  
                    $this->homeModel->imgFolderName = $data['imgFolderName']; 
                    $this->homeModel->name = $data['homeName'];
                    $this->homeModel->city = $data['city'];
                    $this->homeModel->price = $data['price']; 

                    if ($this->homeModel->addHome()) {
                        $data['feedBack'] = "Your home has been added succesfully.";
                    } 
            }else{
                $data['feedBack'] = "An error ocurred while submiting your home. Pleas, try again later.";
            } 
        }

        $this->view('Users/AdminPanel/AddHomeForm', $data, $errors);
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
