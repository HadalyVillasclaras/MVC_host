<?php
    class BookingsController extends Controller{ 
        public function __construct(){
            $this->bookingsModel = $this->model('Bookings');
        }

        public function checkAvailability(){ 

            $data = [ 
                'homeId' => $_GET['id'],
                'startDateError' => '',
                'endDateError' => '',
                'guestsError' => '',
                'reservationError' => '',
                'availableHome' => false
            ]; 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); //sanitize

                if(isset($_POST['check-availability'])){ 
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];
                    $guests = $_POST['guests'];

                    if(empty($startDate)){
                        $data['startDateError'] = 'Field must be filled';
                    }
                    if(empty($endDate)){
                        $data['endDateError'] = 'Field must be filled';
                    } 
                    if(empty($guests)){
                        $data['guestsError'] = 'Field must be filled';
                    }

                    if(empty($data['startDateError']) && empty($data['endDateError']) && empty($data['guestsError'])){
                        $this->bookingsModel->userId = $_SESSION['user_id']; 
                        $this->bookingsModel->homeId = $_GET['id'];
                        $this->bookingsModel->startDate = $startDate; 
                        $this->bookingsModel->endDate = $endDate; 
                        $this->bookingsModel->guests = $guests; 

                        if($this->bookingsModel->checkAvailability()){
                            $data['reservationError'] = 'Available dates.';
                            $data['availableHome'] = true;

                        }else{
                            $data['reservationError'] = 'Not available dates.';
                        };
                    }
                }
            }
            $this->view('Home/home', $data);  

 
        }


        public function checkOut(){
            if(!isLoggedIn()){
                header("Location: " . BASE_URL . 'userscontroller/login');
            }

            $data = [
                //añadir id para ver quien ha hecho el submit $_SESSION['id']
                'startDateError' => '',
                'endDateError' => '',
                'guestsError' => '',
                'reservationError' => ''
            ];

           




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

        
    }




?>