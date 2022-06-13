<?php
    require_once 'manual.php';

    class HomesModel extends Manual{
        public function __construct(){
            parent::__construct(); //conexion
        }

        private $name; 
        private $city;  
        private $price;  

        function getName(){
            return $this->name;
        }
        
        function getCity(){
            return $this->city;
        }

        function getPrice(){
            return $this->price;
        }

        function setName($name){
            $this->name = $name;
        }
        
        function setCity($city){
            $this->city = $city;
        }

        function setPrice($price){
            $this->price = $price;
        }




        //Insert Home
        public function InsertHome(){
            $sql = "INSERT INTO Homes(Name, City, Price) VALUES (:name, :city, :price );";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":name"=>$this->name, ":city"=>$this->city, ":price"=>$this->price)); 
        }

        public function EditHome(){
            $sql = "UPDATE Homes SET Name = :name, City = :city WHERE Price = :price";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":name"=>$this->name, ":city"=>$this->city, ":price"=>$this->price)); 
        }


        public function DeleteHome(){
            $sql = "DELETE FROM Homes WHERE Price = :price";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":price"=>$this->price));
        }

        
    }




?>