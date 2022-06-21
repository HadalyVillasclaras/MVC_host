<?php
    require_once 'manual.php';

    class User extends Manual{

        private $name; 
        private $surname;
        private $email;  
        private $pass;  


        public function __construct(){
            parent::__construct(); //conexion
        }

        public function register($data){
            $sql = "INSERT INTO Users(Name, Surname, Email, Password) VALUES (:name, :surname, :email, :pass);";
            $stmt= $this->connection->prepare($sql);
            $result = $stmt->execute(array(":name"=>$data['name'], ":surname"=>$data['surname'], ":email"=>$data['email'], ":pass"=>$data['password'])); 
        
            if($result){
                "insert ok";
                return true;
            }else{
                echo "error con la bd";
                return false;
            }
        
        }
        
        public function findUserEmail($email){ 
            $sql = "SELECT * FROM Users WHERE Email = :email";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":email"=>$email)); 

            $emailExists = $stmt->fetchAll();
            if($emailExists){
                return true;
            }else{
                return false;
            }
 
            

        }



        
    }




?>