<?php

require_once '../lib/session.php';
require_once '../lib/Image.php';
require_once '../lib/Validations/formsValidation.php';
require_once 'MyPanelController.php';

class HomeController extends Controller
{     
    private $homeModel;
    private $isLoggedIn;

    public function __construct()
    {
        $this->homeModel = $this->model('Home');
        $this->isLoggedIn = new Session();
    }
    
    public function getAllHomes() //Destinations page
    { 
        $allHomes = $this->homeModel->getAll();   
        $this->view('Home/homes', $allHomes);  
    }

    public function getHome() //Single page home 
    { 
        $this->homeModel->id = $_GET['id'];
        $home = $this->homeModel->getById();

        $data = [ 
            'homeId' => $home['id'] ?? '',
            'Name' => $home['name'] ?? '',
            'Price' => $home['price'] ?? '',
            'ImageFolder' => $home['image_folder'] ?? '',
            'ImageName' => $home['image_name'] ?? '',
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
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        $data = [];
        $errors = [];

        if (isset($_POST['submit'])) { 
            $data = [
                'name' => trim($_POST['name']),
                'city' => trim($_POST['city']),
                'price' => trim($_POST['price']),
                'img' => $_FILES['image']
            ];

            $image = new Image($data['img'], $data['name']);
            $errors = FormsValidation::validateHomeFields($data);

            if (empty($errors)) {
                $this->homeModel->img = $image->uniqueImageName();  
                $this->homeModel->imgFolderName = $image->createImgFolderName();
                $this->homeModel->name = $data['name'];
                $this->homeModel->city = $data['city'];
                $this->homeModel->price = $data['price']; 

                $this->homeModel->addHome();
                $image->saveImageInFolder();
            } else {
                echo 'error';
            }  
        }

        $this->view('Users/AdminPanel/AddHomeForm', $data, $errors);
    }


    public function updateHome()
    { 
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        //background view
        $myPanel = new MyPanelController();
        $myPanel->index();

        if (isset($_GET['edit'])) {

            $this->homeModel->id = $_GET['edit'];
            $data = $this->homeModel->getById();   

            if (isset($_POST['submit'])) {
                $data = [
                    'name' => trim($_POST['name']),
                    'city' => trim($_POST['city']),
                    'price' => trim($_POST['price']),
                    'img' => $_FILES['image'],
                    'feedBack' => ''
                ];

                $image = new Image($data['img'], $data['name']);
                $errors = FormsValidation::validateHomeFields($data);
 
                if (empty($errors)) {
                    $this->homeModel->img = $image->newFileName;  
                    $this->homeModel->imgFolderName = $image->imgFolderName; 
                    $this->homeModel->name = $data['name'];
                    $this->homeModel->city = $data['city'];
                    $this->homeModel->price = $data['price'];

                    $this->homeModel->updateHome();
                    $image->saveImageInFolder();
                }else {
                    echo 'error';
                }
            }

            $this->view('Users/AdminPanel/updateHomeForm', $data, $errors); 
        }
    }
    
    public function deleteHome()
    { 
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        //background view
        $myPanel = new MyPanelController();
        $myPanel->index();

        if (isset($_GET['delete'])) {
            $this->homeModel->id = $_GET['delete'];
            $homeToDelete = $this->homeModel->getById(); 
        
            if (isset($_POST['delete'])) {
                if ($this->homeModel->deleteHome() == 1) {
                    $data['feedBack'] = "Home has been deleted.";
                } else {
                    $data['feedBack'] = "An error ocurred while deleting this home. Pleas, try again later.";
                } 

                //delete imgs and folder too
            } 
        }
        $this->view('Users/AdminPanel/DeleteConfirmationMsg', $homeToDelete);   
    } 
} 
