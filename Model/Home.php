<?php
    require_once 'manual.php';

    class Home extends Manual
    {
        protected $table = 'Homes';
        protected $id;
        protected $name;
        protected $city;
        protected $price; 
        protected $img;
        protected $imgFolder;
        
        public function __construct ()
        {
            parent::__construct(); //conexion 
           
        }
        

        //Insert Home
        public function addHome()
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
 

        public function updateHome()
        {    
            $sql = "UPDATE Homes SET Name = :name, city = :city, price = :price WHERE id =:id";
            $stmt= $this->connection->prepare($sql); 
            
            $stmt->execute(array(
                ":id"=>$this->id, 
                ":name"=>$this->name, 
                ":city"=>$this->city, 
                ":price"=>$this->price
            )); 

        }


        public function deleteHome()
        {
            $sql = "DELETE FROM Homes WHERE id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->id));
        }
    }
