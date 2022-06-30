<?php
    require_once 'manual.php';

    class Bookings extends Manual{
        public $id;
        public $userId;
        public $homeId;
        public $startDate;
        public $endDate;
        public $guests;
        public $totalCost;  

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

        function checkAvailability(){
            $sql = "SELECT * FROM Bookings WHERE Home_id = :homeId AND 
            (Start_date BETWEEN :startDate AND :endDate) OR 
            (End_date BETWEEN :startDate AND :endDate) ";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":homeId"=>$this->homeId, ":startDate"=>$this->startDate, ":endDate"=>$this->endDate, ":startDate"=>$this->startDate, ":endDate"=>$this->endDate)); 
            $availableHome = $stmt->fetchAll();
            
            if(empty($availableHome)){
                echo "disponible para reservar";
                return true;
            }else{
                echo "no disponible para reservar";
                return false;
            }
        
        }



        //Insert 
        public function insertReservation(){ 
                $sql = "INSERT INTO Bookings(User_id, Home_id, Start_date, End_date, Guests, Cost) VALUES (:user_id, :home_id, :startdate, :enddate, :guests, :cost);";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(array(":user_id"=>$this->userId, ":home_id"=>$this->homeId, ":startdate"=>$this->startDate, ":enddate"=>$this->endDate, ":guests"=>$this->guests, ":cost"=>$this->totalCost)); 
                
        }
 
        public function EditHome(){    
            $sql = "UPDATE Homes SET Name = :name, City = :city, Price = :price WHERE Id =:id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->id, ":name"=>$this->name, ":city"=>$this->city, ":price"=>$this->price)); 
        }


        public function DeleteHome($id){
            echo $id;
            $sql = "DELETE FROM Homes WHERE Id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$id));
        }

        
    }




?>