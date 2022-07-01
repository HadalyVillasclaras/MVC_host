<?php
    class BookingsController extends Controller{ 
        public function __construct(){
            $this->bookingsModel = $this->model('Bookings');
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
                        $this->bookingsModel->userId = $_SESSION['user_id']; 
                        $this->bookingsModel->homeId = $_GET['id'];
                        $this->bookingsModel->startDate = $data['startDate']; 
                        $this->bookingsModel->endDate = $data['endDate']; 
                        $this->bookingsModel->guests = $data['guests'] ; 
 
                        if($this->bookingsModel->checkAvailability()){
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
            if(!isLoggedIn()){
                header("Location: " . BASE_URL . 'userscontroller/login');
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


            $this->view('Booking/checkout', $data);   

        }

        public function submitReservation($data){
            $this->bookingsModel->userId = $data['UserId'];
            $this->bookingsModel->homeId = $data['HomeId'];
            $this->bookingsModel->startDate = $data['startDate'];
            $this->bookingsModel->endDate = $data['endDate'];
            $this->bookingsModel->guests = $data['Guests'];
            $this->bookingsModel->totalCost = $data['totalCost']; 
            
            $this->bookingsModel->insertBooking();  
        }


        public function cancel(){
            $booking = $this->bookingsModel->findBookingByUserId();

            //comprobar que el que va aeditar o cancelar es el dueño de la reserva
            // if(!isLoggedIn()){
            //     header("Location: " . BASE_URL . 'userscontroller/login');
            // }elseif($booking['user_id'] != $_SESSION['user_id']){
            //     header("Location: " . BASE_URL . 'userscontroller/login');
            // }
            

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