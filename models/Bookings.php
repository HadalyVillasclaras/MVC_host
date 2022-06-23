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
        public function InsertHome(){ 
 
                $sql = "INSERT INTO Homes(Name, City, Price) VALUES (:name, :city, :price);";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(array(":name"=>$this->name, ":city"=>$this->city, ":price"=>$this->price)); 
                return true;
              
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