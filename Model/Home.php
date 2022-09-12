<?php
require_once 'manual.php';

class Home extends Manual
{
    protected $table = 'Homes';
    public $id;
    public $name;
    public $city;
    public $price; 
    public $img;
    public $imgFolderName;
    
    public function __construct ()
    {
        //Connection 
        parent::__construct(); 
    }
    
    public function addHome()
    {
        $sql = "INSERT INTO $this->table(name, city, price, image_name, image_folder) VALUES (:name, :city, :price, :img, :imgFolderName);";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array(
            ":name" => $this->name, 
            ":city" => $this->city, 
            ":price" => $this->price, 
            ":img" => $this->img, 
            ":imgFolderName" => $this->imgFolderName
        )); 
        
        return $stmt->rowCount();
    }

    public function updateHome()
    {    
        $sql = "UPDATE $this->table SET Name = :name, city = :city, price = :price WHERE id =:id";
        $stmt = $this->connection->prepare($sql); 
        $stmt->execute(array(
            ":id" => $this->id, 
            ":name" => $this->name, 
            ":city" => $this->city, 
            ":price" => $this->price
        )); 

        return $stmt->rowCount();
    }

    public function deleteHome()
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array(":id"=>$this->id));

        return $stmt->rowCount();
    }
}
