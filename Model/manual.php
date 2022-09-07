<?php

namespace Model;

use config\Connection;


class Manual
{
    protected $connection; 

    public function __construct()
    {
        $newConnection = new Connection();
        $this->connection = $newConnection->Connect();    
    }

    public function getAll($table)
    { 
        $sqlQuery = "SELECT * FROM $table";
        $result = $this->connection->query($sqlQuery);
        $result->fetch();
        return $result; 
    }

    function getSingleRow()
    {
        $sqlQuery = "SELECT * FROM $this->table WHERE id = :id";
        $stmt= $this->connection->prepare($sqlQuery);
        $stmt->execute(array(":id" => $this->id)); 
        $result = $stmt->fetch(); 
        return $result;
    }
}