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
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->connection->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result; 
    }

    public function getById()
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute(array(":id" => $this->id)); 
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result;
    }
}