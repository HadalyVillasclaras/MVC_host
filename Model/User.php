<?php



require_once 'manual.php';

class User extends Manual
{ 
    public $table = 'Users';
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

    
    public function login($email, $password)
    {
        $sql = "SELECT * FROM Users WHERE email = :email";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute(array(":email"=>$email)); 
        $row = $stmt->fetch(); //single
        $hashedPassword = $row['password'];

        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }

    

    public function register()
    {
        $sql = "INSERT INTO Users(first_name, last_name, email, password, role) 
                VALUES (:name, :surname, :email, :pass, :role);";
        $stmt= $this->connection->prepare($sql);
        $result = $stmt->execute(array(
            ":name"=>$this->name, 
            ":surname"=>$this->surname, 
            ":email"=>$this->email, 
            ":pass"=>$this->password,
            ":role"=>$this->role
        )); 
    
        if($result){ 
            return true;
        }else{ 
            return false;
        }
    
    }

    public function findUserById()
    { 
        $sql = "SELECT * FROM Users WHERE id = :id";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute(array(":id"=>$this->id)); 
        $result = $stmt->fetch();

        return $result;
    }
    
    public function findUserEmail($email)
    { 
        $sql = "SELECT * FROM Users WHERE email = :email";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute(array(":email"=>$email)); 
        $emailExists = $stmt->fetchAll();

        if($emailExists){
            return true;
        }else{
            return false;
        }
    }

    public function checkRole()
    {
        $sql = "SELECT * FROM Users WHERE id = :id";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute(array(":id"=>$this->id)); 
        $role = $stmt->fetch();
        return $role;
    }
}
?>