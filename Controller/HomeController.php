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
        var_export($allHomes);
        $this->view('Home/homes', $allHomes);  
    }

    public function getHome() //Single page home 
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
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        $data = [];
        $errors = [];
        if (isset($_POST['submit'])) { 
            $data['name'] = trim($_POST['name']);
            $data['city'] = trim($_POST['city']);
            $data['price'] = trim($_POST['price']);
            $data['img'] = $_FILES['image'];

            $image = new Image($data['img'], $data['name']);
            $image->saveImage();
            $data['newImgName'] = $image->newFileName;
            $data['imgFolderName'] = $image->imgFolderName;

            $validations = new FormsValidation();
            $errors = $validations->validateHomeFields($data);
            var_dump($errors);
            if (count($errors) === 0) {
                    $this->homeModel->img = $data['newImgName'];  
                    $this->homeModel->imgFolderName = $data['imgFolderName']; 
                    $this->homeModel->name = $data['name'];
                    $this->homeModel->city = $data['city'];
                    $this->homeModel->price = $data['price']; 

                    if ($this->homeModel->addHome() == 1) {
                        $data['feedBack'] = "Your home has been added succesfully.";
                    } else {
                        $data['feedBack'] = "An error ocurred while submiting your home. Pleas, try again later.";
                    } 
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

        if(isset($_GET['edit'])){
            $this->homeModel->id = $_GET['edit'];
            $data = $this->homeModel->getSingleRow();   

            if (isset($_POST['submit'])) {
                $data = [];
                $data['name'] = trim($_POST['name']);
                $data['city'] = trim($_POST['city']);
                $data['price'] = trim($_POST['price']);
                $data['img'] = $_FILES['image'];
                $data['feedBack'] = '';
                $image = new Image($data['img'], $data['name']);
                $image->saveImage();
                $data['newImgName'] = $image->newFileName;
                $data['imgFolderName'] = $image->imgFolderName;

                $validations = new FormsValidation();
                $errors = $validations->validateHomeFields($data);
 
                if (count($errors) === 0) {
                    $this->homeModel->img = $data['newImgName'];  
                    $this->homeModel->imgFolderName = $data['imgFolderName']; 
                    $this->homeModel->name = $data['name'];
                    $this->homeModel->city = $data['city'];
                    $this->homeModel->price = $data['price'];

                    if ($this->homeModel->updateHome() == 1) {
                        $data['feedBack'] = "Your home has been updated succesfully.";
                    } else {
                        $data['feedBack'] = "An error ocurred while updating your home. Pleas, try again later.";
                    } 
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
            $homeToDelete = $this->homeModel->getSingleRow(); 
        
            if (isset($_POST['delete'])) {
                if ($this->homeModel->deleteHome() == 1) {
                    $data['feedBack'] = "Home has been deleted.";
                } else {
                    $data['feedBack'] = "An error ocurred while deleting this home. Pleas, try again later.";
                } 
            } 
        }
        $this->view('Users/AdminPanel/DeleteConfirmationMsg', $homeToDelete);   
    } 
} 
