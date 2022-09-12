<?php

require_once 'manual.php';

class User extends Manual
{ 
    protected $table = 'Users';
    public $id;
    public $name; 
    public $surname;
    public $email;  
    public $password;  
    private $role = 'Guest';

    public function __construct()
    {
        parent::__construct(); //conexion
    } 

    
    public function login()
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute(array(":email"=>$this->email)); 
        $row = $stmt->fetch();
        $hashedPassword = $row['password'];

        if (password_verify($this->password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function addUser()
    {
        $sql = "INSERT INTO $this->table(first_name, last_name, email, password, role) 
                VALUES (:firstName, :lastName, :email, :pass, :role);";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array(
            ":firstName"=>$this->name, 
            ":lastName"=>$this->surname, 
            ":email"=>$this->email, 
            ":pass"=>$this->password,
            ":role"=>$this->role
        )); 
    
        return $stmt->rowCount();
    }
    
    public function updateUser()
    {    
        $sql = "UPDATE $this->table SET first_name = :firstName, last_name = :lastName, email = :email WHERE id =:id";
        $stmt = $this->connection->prepare($sql); 
        $stmt->execute(array(
            ":id" => $this->id, 
            ":firstName" => $this->name, 
            ":lastName"=>$this->surname, 
            ":email"=>$this->email
        )); 

        return $stmt->rowCount();
    }

    public function deleteUser()
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array(":id"=>$this->id));

        return $stmt->rowCount();
    }

    public function checkIfEmailExists($email)
    { 
        $sql = "SELECT 1 FROM $this->table WHERE email = :email";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute(array(":email"=>$email)); 
        $emailExists = $stmt->fetchColumn();

        return $emailExists;
    }

    public function checkRole()
    {
        $sql = "SELECT role FROM $this->table WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array(":id"=>$this->id)); 
        $role = $stmt->fetchColumn();
        
        return $role;
    }
}
