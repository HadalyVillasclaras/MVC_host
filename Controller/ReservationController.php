<?php

namespace Controller\ReservationsController;

use Controller\Controller;
use libraries\Session;

class ReservationsController extends Controller{ 
    public function __construct(){
        $this->reservationsModel = $this->model('Reservation');
        $this->homeModel = $this->model('Home');
    }

    public function checkAvailability(){ 
        $id = $_GET['id'];
        $this->homeModel->id = $id;
        $home = $this->homeModel->getSingleRow();
        $data = [ 
            'homeId' => $id,
            'homeId' => $home['Id'],
            'Name' => $home['Name'],
            'Price' => $home['Price'],
            'ImageFolder' => $home['ImageFolder'],
            'ImageName' => $home['ImageName'], 

            'totalCost' => '',
            'Nights' => '',

            'startDateError' => '',
            'endDateError' => '',
            'guestsError' => '',
            'reservationFeedback' => '',
            'availableHome' => false
        ]; 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); //sanitize

            $data = [ 
                'homeId' => $id,
                'homeId' => $home['Id'],
                'Name' => $home['Name'],
                'Price' => $home['Price'],
                'ImageFolder' => $home['ImageFolder'],
                'ImageName' => $home['ImageName'],

                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'guests' => $_POST['guests'],

                'errorFeedback' => '', 
                'reservationFeedback' => '',
                'availableHome' => false
            ]; 
            if(isset($_POST['check-availability'])){ 
                $startDate = $_POST['startDate'];
                $endDate = $_POST['endDate'];
                $guests = $_POST['guests'];

                if(empty($startDate) | empty($endDate) | empty($guests)){
                    $data['errorFeedback'] = 'Field must be filled';
                } 

                if(empty($data['startDateError']) && empty($data['endDateError']) && empty($data['guestsError'])){
                    $this->reservationsModel->userId = $_SESSION['user_id']; 
                    $this->reservationsModel->homeId = $_GET['id'];
                    $this->reservationsModel->startDate = $data['startDate']; 
                    $this->reservationsModel->endDate = $data['endDate']; 
                    $this->reservationsModel->guests = $data['guests'] ; 

                    if($this->reservationsModel->checkAvailability()){
                        $data['reservationFeedback'] = 'Available dates.';
                        $data = $this->calculateCost($data);
                        
                        $data['availableHome'] = true;

                    }else{
                        $data['reservationFeedback'] = 'Not available dates.';
                    };
                }
            }
        }
        $this->view('Home/singleHome', $data);  
    }


    public function checkOut(){
        $isLoggedIn = new Session();

    if (!$isLoggedIn->isLoggedIn()) {
        header("Location: " . BASE_URL . 'usercontroller/login');
    }


        $this->homeModel->id = $_GET['id'];
        $home = $this->homeModel->getSingleRow();

        $data = [
            'UserId' => $_SESSION['user_id'],
            'HomeId' => $_GET['id'],
            'Name' => $home['Name'],
            'City' => $home['City'],
            'Price' => $home['Price'],
            'ImageName' => $home['ImageName'],
            'ImageFolder' => $home['ImageFolder'],

            'startDate' => $_GET['checkin'],
            'endDate' => $_GET['checkout'],
            'Guests' => $_GET['guests'],
            'Nights' => '',
            'totalCost' => ''
        ];

        $data = $this->calculateCost($data); 
        $this->submitReservation($data);


        $this->view('Reservation/checkout', $data);   

    }

    public function submitReservation($data){
        $this->reservationsModel->userId = $data['UserId'];
        $this->reservationsModel->homeId = $data['HomeId'];
        $this->reservationsModel->startDate = $data['startDate'];
        $this->reservationsModel->endDate = $data['endDate'];
        $this->reservationsModel->guests = $data['Guests'];
        $this->reservationsModel->totalCost = $data['totalCost']; 
        
        $this->reservationsModel->insertReservation();  
    }




    public function calculateCost($data){
        $prize = $data['Price'];
            
        $startDate = strtotime($data['startDate']);
        $endDate = strtotime($data['endDate']);
        $nights = ($endDate - $startDate) / (60 * 60 * 24);

        $totalCost = $prize * $nights;
        
        $data['Nights'] = $nights;
        $data['totalCost'] = $totalCost;

        return $data;
    }
    
}




?>