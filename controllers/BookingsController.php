<?php
    class BookingController extends Controller{ 
        public function __construct(){
            $this->bookingsModel = $this->model('Bookings');
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