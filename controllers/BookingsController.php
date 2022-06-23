<?php
    class BookingController extends Controller{ 
        public function __construct(){
            $this->bookingsModel = $this->model('Bookings');
        }




        public function cancel(){
            $booking = $this->bookingsModel->findBookingByUserId();

            

        }

        
    }




?>