<?php
    require_once 'manual.php';

    class Home extends Manual
    {
        public $table = 'Homes';
        public $id = '';
        public $name = ''; 
        public $city = '';  
        public $price = '';  
        public $img = '';
        public $imgFolder = '';
        

        public function __construct()
        {
            parent::__construct(); //conexion 
        }
        

        //Insert Home
        public function InsertHome()
        {
            if($this->img) {
                $sql = "INSERT INTO Homes(name, city, price, image_name, image_folder) VALUES (:name, :city, :price, :img, :imgfolder);";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(array(
                    ":name" => $this->name, 
                    ":city" => $this->city, 
                    ":price" => $this->price, 
                    ":img" => $this->img, 
                    ":imgfolder" => $this->imgFolder
                )); 
                return true;
            }else{
                return false;
            }  
        }
 

        public function EditHome()
        {    
            $sql = "UPDATE Homes SET Name = :name, city = :city, price = :price WHERE id =:id";
            $stmt= $this->connection->prepare($sql); 
            
            $result = $stmt->execute(array(
                ":id"=>$this->id, 
                ":name"=>$this->name, 
                ":city"=>$this->city, 
                ":price"=>$this->price
            )); 

        }


        public function DeleteHome()
        {
            $sql = "DELETE FROM Homes WHERE id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->id));
        }
    }
