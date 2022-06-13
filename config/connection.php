<?php
    require_once("config.php");

    Class Connection{
        private $connection;

        public function Connect(){
            try{
                $this->connection = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME.'', DB_USER, DB_PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "con ok"; 
                return $this->connection;
            }catch(Exception $e){
                echo "Error: " . $e->getLine();
            }
        } 
    } 
?>
 