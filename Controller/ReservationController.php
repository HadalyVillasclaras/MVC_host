<?php

class ReservationController extends Controller
{
    private $isLoggedIn;
    
    public function __construct(){
        $this->reservationsModel = $this->model('Reservation');
        $this->homeModel = $this->model('Home');
        $this->isLoggedIn = new Session();
    }

    public function checkAvailability(){
            $data = [];
            $errors = [];
        
            if (isset($_POST['check-availability'])) {  
                $this->homeModel->id = $_POST['id'];
                $home = $this->homeModel->getById();

                $data = [ 
                    'startDate' => $_POST['startDate'] ?? '',
                    'endDate' => $_POST['endDate'] ?? '',
                    'guests' => $_POST['guests'] ?? '',
                    
                    'availableHome' => false
                ]; 
                
                $error = [
                    'errorFeedback' => '', 
                    'reservationFeedback' => ''
                ];

                //Check empty values
                if (empty($data['startDate'])) {
                    $error['startDate'] = "Please, select a start date";   
                }
                
                if (empty($data['endDate'])) {
                    $error['endDate'] = "Please, select a end date";   
                }
                
                if (empty($data['endDate'])) {
                    $error['guests'] = "Please, select number of guests";   
                }
                

                //if everything ok:
                $this->reservationsModel->userId = $_SESSION['user_id']; 
                $this->reservationsModel->homeId = $_GET['id'];
                $this->reservationsModel->startDate = $data['startDate']; 
                $this->reservationsModel->endDate = $data['endDate']; 
                $this->reservationsModel->guests = $data['guests'] ; 

                
                $availability = $this->reservationsModel->checkAvailability();
                
                if ($availability) {
                    $data['availableHome'] = true;
                    $data['reservationFeedback'] = 'Available dates.';
                    
                    $cost = $this->calculateCost($data); //buscar método
                    
                }else{
                    $data['reservationFeedback'] = 'Not available dates.';
                };
                
            }
        
        $this->view('Home/singleHome', $data, $errors);  
    }


    public function checkOut()
    {
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        if (isset($_GET['id'])) {
            
            $this->homeModel->id = $_GET['id'];
            $home = $this->homeModel->getById();  

            $data = [
                'UserId' => $_SESSION['user_id'],
                'HomeId' => $_GET['id'],
                'Name' => $home['name'],
                'City' => $home['city'],
                'Price' => $home['price'],
                'ImageName' => $home['imageName'],
                'ImageFolder' => $home['imageFolder'],
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
