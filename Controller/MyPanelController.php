<?php

require_once '../libraries/session.php';
require_once '../libraries/Validations/Password.php';
require_once '../libraries/Validations/Email.php';

class MyPanelController extends Controller
{
    private $isLoggedIn;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->homeModel = $this->model('Home');
        $this->reservationModel = $this->model('Reservation');
        $this->isLoggedIn = new Session();
    }


    public function index(){
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        $userId = $_SESSION['user_id']; 
        $this->userModel->id  = $userId; 
        $role = $this->userModel->checkRole();

        $this->reservationModel->userId  =  $userId; 

        if($role['role'] == 'Admin'){
            $data['homes'] = $this->homeModel->getAll('Homes');   
            $data['reservations'] = $this->reservationModel->getAll('Reservations');   
            $data['userInfo'] = $this->userModel->findUserById();

            $this->view('Users/AdminPanel/Index', $data); 

        } elseif ($role['role'] == 'Guest') { 
            $data['userInfo'] = $this->userModel->findUserById();
            $data['userReservations'] = $this->reservationModel->findReservationByUserId();

            $this->view('Users/GuestPanel/Index', $data); 
        } 
    }
}