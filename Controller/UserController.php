<?php
require_once '../lib/session.php';
require_once '../lib/Validations/Password.php';
require_once '../lib/Validations/Email.php';

class UserController extends Controller
{
    private $isLoggedIn;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->homeModel = $this->model('Home');
        $this->reservationModel = $this->model('Reservation');
        $this->isLoggedIn = new Session();
    }
    
    public function login()
    {
        //Si ya está loggeado, header location to my panel
       
        if (isset($_POST['login'])) {
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password'])
            ];
            
            // check if empty or null validation
            //check if valid pass and user
            $errors = []; //save errors here if exists

            //Login
            if (count($errors) === 0) {
                $loggedUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedUser) {
                    $this->createSession($loggedUser);
                } else {
                    $data['feedback'] = 'Error login credentials.';
                }
            }
        }
        
        $this->view('Users/login', $data = [], $errors = []);  
    }

    public function logout(){
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['user_id']);
        session_destroy();
        header('location: ' . BASE_URL);
    }
    
    public function register(){

        $data = [];
        
        if (isset($_POST['register'])) {  
            $data = [
                'name' => trim($_POST['name']),
                'surname' => trim($_POST['surname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword'])
            ];

            //Validate email
            $emailValidation = new Email($data['email']);
            $errors['email'] = $emailValidation->validateEmail();

            if ($this->userModel->findUserEmail($data['email'])){
                $errors['email'] = 'Email already exists!';
            }

            //Validate password & confirm password
            $password =  new Password($data['password']);
            $errors['password'] = $password->validatePassword();
            $errors['confirmPassword'] = $password->validateConfirmPassword($data['confirmPassword']);

            if (count($errors) === 0) {
                $this->userModel->name = $data['name'];
                $this->userModel->surname = $data['surname'];
                $this->userModel->email = $data['email'];
                $this->userModel->password = $password->passwordHash();;


                if ($this->userModel->register()) {
                    $data['feedBack'] = "User registered.";
                } else {
                    $data['feedBack'] = "An error ocurred while registering. Pleas, try again later.";
                } 
            }
        }
        $this->view('Users/register', $data, $errors);  
    }






    public function createSession($user){ 
        require_once '../lib/session.php';
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['first_name'];
        $_SESSION['user_id'] = $user['id']; 

        echo "eeeeeeeeeeeeeeeeeeecreateSSession()";
        var_dump($_SESSION);
        // header('location: ' . BASE_URL);
    }
    


}
