<?php

require_once '../config/connection.php';

class Manual
{
    protected $connection; 

    public function __construct()
    {
        $newConnection = new Connection();
        $this->connection = $newConnection->Connect();    
    }

    public function getAll()
    { 
        $sqlQuery = "SELECT * FROM $this->table";
        $result = $this->connection->query($sqlQuery);
        $result->fetch();
        return $result; 
    }

    public function getSingleRow()
    {
        $sqlQuery = "SELECT * FROM $this->table WHERE id = :id";
        $stmt= $this->connection->prepare($sqlQuery);
        $stmt->execute(array(":id" => $this->id)); 
        $result = $stmt->fetch(); 
        return $result;
    }
}