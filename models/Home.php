<?php
    require_once 'manual.php';

    class Home extends Manual{
        private $id;
        private $name; 
        private $city;  
        private $price;  
        private $img;

        public function __construct(){
            parent::__construct(); //conexion 
        }
        
        function getId(){
            return $this->id;
        }

        function getName(){
            return $this->name;
        }
        
        function getCity(){
            return $this->city;
        }

        function getPrice(){
            return $this->price;
        }

        function getImage(){
            return $this->img;
        }

        function setId($id){
            $this->id = $id;
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

        function setImage($img){
            $this->img = $img;
        } 


        function getHome(){
            $sql = "SELECT * FROM Homes WHERE Id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->id)); 
            $homex = $stmt->fetch(); 
            return $homex;
        }

        //Insert Home
        public function InsertHome(){
            $fileName = $this->checkImage();
             echo $fileName;

            if($fileName){
                $sql = "INSERT INTO Homes(Name, City, Price, ImageName) VALUES (:name, :city, :price, :img);";
                $stmt= $this->connection->prepare($sql);
                $stmt->execute(array(":name"=>$this->name, ":city"=>$this->city, ":price"=>$this->price, ":img"=>$fileName)); 
                return true;
            }else{
                return false;
            }
            
            
            
        }

        public function checkImage(){
            $img = $this->img;

            $fileName = $img['name'];
            $fileTmpName = $img['tmp_name'];
            $fileSize = $img['size'];
            $fileError = $img['error'];
            $fileType = $img['type'];

            //check extension
            $fileExt = explode('.', $fileName);
            $fileExtCheck = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');

             
                if(in_array($fileExtCheck, $allowed)){ //si fileExtCheck includes any of allowed array
                    if($fileError === 0){
                        if($fileSize < 10000000){
                            $fileNameNew = uniqid('', true).'.'.$fileExtCheck;
                            $filePath = 'assets/img/'.$fileNameNew;
                            move_uploaded_file($fileTmpName, $filePath);
                            return $fileNameNew; 
                        }else{
                            echo "Please, upload an image with no more than 500MB.";
                            return false;
                        }
                    }else{
                        echo "There was an error uploading your file.";
                        return false;
                    }
                }else{
                    echo "Please, upload an image of any of these formats: jpg, jpeg or png.";
                    return false;
                } 
             
            
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