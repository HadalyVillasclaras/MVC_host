<?php
    require_once '../config/connection.php';

    class Manual{
        public $connection; 
        public function __construct(){
            $con = new Connection();
            $this->connection = $con->Connect();    
        }
 
        public function getAll($table){ 
            $sql = "SELECT * FROM $table";
            $result = $this->connection->query($sql);
            $result->fetch();
            return $result; 
        }

        function getSingleRow(){
            $sql = "SELECT * FROM $this->table WHERE Id = :id";
            $stmt= $this->connection->prepare($sql);
            $stmt->execute(array(":id"=>$this->id)); 
            $result = $stmt->fetch(); 
            return $result;
        }

    } 

?>