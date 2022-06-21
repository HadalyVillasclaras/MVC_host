<?php
    require_once("config.php");
    Class Connection{
        private $connection;

        public function Connect(){ 
            try{
                $this->connection = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME.'', DB_USER, DB_PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_PERSISTENT, TRUE);
                return $this->connection;
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        } 
    } 
?>
 