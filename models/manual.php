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
            return $result; 
        }

    } 

?>