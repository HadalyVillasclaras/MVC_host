<?php
    require_once 'manual.php';

    class Reservation extends Manual
    {
        public $table = 'Reservation';
        public $id;
        public $userId;
        public $homeId;
        public $startDate;
        public $endDate;
        public $guests;
        public $totalCost;  

        public function __construct()
        {
            parent::__construct(); //conexion
            
            
        }
         

        function getReservation()
        { 
            $sql = "SELECT * FROM Reservation WHERE id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->id)); 
            $reservations = $stmt->fetch(); 
            return $reservations;
        }

        function findReservationByUserId()
        {
            $sql = "SELECT * FROM Reservations WHERE user_id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->userId)); 
            $reservations = $stmt->fetchAll(); 
            return $reservations;
        }

        function checkAvailability()
        {
            $sql = "SELECT * FROM Reservations WHERE home_id = :homeId AND 
            (start_date BETWEEN :startDate AND :endDate) OR 
            (end_date BETWEEN :startDate AND :endDate) ";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":homeId"=>$this->homeId, ":startDate"=>$this->startDate, ":endDate"=>$this->endDate, ":startDate"=>$this->startDate, ":endDate"=>$this->endDate)); 
            $availableHome = $stmt->fetchAll();
            
            if(empty($availableHome)){ 
                return true;
            }else{ 
                return false;
            }
        
        }



        
        public function insertReservation()
        { 
                $sql = "INSERT INTO Reservations(user_id, home_id, start_date, end_date, guests, cost) VALUES (:user_id, :home_id, :startdate, :enddate, :guests, :cost);";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(array(":user_id"=>$this->userId, ":home_id"=>$this->homeId, ":startdate"=>$this->startDate, ":enddate"=>$this->endDate, ":guests"=>$this->guests, ":cost"=>$this->totalCost)); 
                
        }
 
        public function editReservation()
        {    
            $sql = "UPDATE Reservations SET name = :name, city = :city, price = :price WHERE id =:id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->id, ":name"=>$this->name, ":city"=>$this->city, ":price"=>$this->price)); 
        }


        public function deleteReservation()
        { 
            $sql = "DELETE FROM Reservations WHERE id = :id";
            $stmt= $this->connection->prepare($sql);
            //$stmt->execute());
        }

        
    }




?>