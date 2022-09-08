<?php
require_once '../libraries/session.php';
require_once '../libraries/Image.php';
require_once '../libraries/Validations/formsValidation.php';

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
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        if (isset($_POST['submit'])) { 
            $data['homeName'] = trim($_POST['name']);
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
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        // Background view
        $homes = $this->homeModel->getAll();   
        $this->view('Users/AdminPanel/Homes', $homes); 

        if(isset($_GET['edit'])){
            $this->homeModel->id = $_GET['edit'];
            $homeToUpdate = $this->homeModel->getSingleRow();   

            $this->view('Users/AdminPanel/updateHomeForm', $homeToUpdate); 

            if (isset($_POST['submit'])) {
                $data['homeName'] = trim($_POST['name']);
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

                    if ($this->homeModel->updateHome()) {
                        $data['feedBack'] = "Your home has been updated succesfully.";
                    } else {
                        $data['feedBack'] = "An error ocurred while updating your home. Pleas, try again later.";
                    } 
                    
                }

                $this->view('Users/AdminPanel/updateHomeForm', $homeToUpdate, $errors); 
            } 
        }
    }
    
    public function deleteHome()
    { 
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        //background view
        $homes = $this->homeModel->getAll();   
        $this->view('Users/AdminPanel/Homes', $homes); 

        if (isset($_GET['delete'])) {
            $this->homeModel->id = $_GET['delete'];
            $homeToDelete = $this->homeModel->getSingleRow(); 

            $this->view('Users/AdminPanel/DeleteConfirmationMsg', $homeToDelete);   

            if (isset($_POST['delete'])) {
                $this->homeModel->deleteHome();

                var_dump($_SERVER['HTTP_REFERER']); 
            } 
        }
    } 
} 
