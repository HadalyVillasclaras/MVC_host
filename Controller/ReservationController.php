<?php

class ReservationController extends Controller{ 
    public function __construct(){
        $this->reservationsModel = $this->model('Reservation');
        $this->homeModel = $this->model('Home');
    }

    public function checkAvailability(){ 
            if(isset($_GET['check-availability'])){ 
                $data = [];
                $id = $_GET['id'];
                $this->homeModel->id = $id;
                $home = $this->homeModel->getById();

                $data = [ 
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
        
        $this->view('Home/singleHome', $data);  
    }


    public function checkOut(){
        $isLoggedIn = new Session();

        if (!$isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        if (isset($_GET['id'])) {
            $this->homeModel->id = $_GET['id'];
            $home = $this->homeModel->getById();  

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
                'Guests' => $_GET['guests']
            ];

            //require Reservation Class,
            $reservation = new Reservation($data);

            $data = [
                'Nights' =>  $reservation->calculateTotalNights(),
                'totalCost' => $reservation->calculateCost()
            ];

            //check if errors and:
            $this->submitReservation($data);
        }
    
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
    
}
