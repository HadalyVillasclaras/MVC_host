<?php
    require_once 'manual.php';

    class Bookings extends Manual{
        private $id;
        private $userId;
        private $date;

        private $name; 
        private $city;  
        private $price;  

        public function __construct(){
            parent::__construct(); //conexion 
        }
        
    


        function getBooking(){
            $sql = "SELECT * FROM Bookings WHERE Id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->id)); 
            $bookings = $stmt->fetch(); 
            return $bookings;
        }

        function findBookingByUserId(){
            $sql = "SELECT * FROM Bookings WHERE UserId = :userId";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->UserId)); 
            $bookings = $stmt->fetch(); 
            return $bookings;
        }

        //Insert 
   

        
    }




?>