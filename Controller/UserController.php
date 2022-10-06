<?php

require_once '../lib/session.php';
require_once '../lib/Validations/Password.php';
require_once '../lib/Validations/Email.php';

class UserController extends Controller
{
    private $isLoggedIn;
    private $homeModel;
    private $userModel;
    private $reservationModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->homeModel = $this->model('Home');
        $this->reservationModel = $this->model('Reservation');
        $this->isLoggedIn = new Session();
    }
    
    public function register()
    {
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

            if ($this->userModel->checkIfEmailExists($data['email']) == 1){
                $errors['email'] = 'Email already exists!';
            }

            //Validate password & confirm password
            $password =  new Password($data['password']);
            $errors['password'] = $password->validatePassword();
            $errors['confirmPassword'] = $password->validateConfirmPassword($data['confirmPassword']);

            
            if (empty($errors)) {
                $this->userModel->name = $data['name'];
                $this->userModel->surname = $data['surname'];
                $this->userModel->email = $data['email'];
                $this->userModel->password = $password->passwordHash();

                if ($this->userModel->addUser() == 1) {
                    $data['feedBack'] = "User registered.";
                } else {
                    $data['feedBack'] = "An error ocurred while registering. Pleas, try again later.";
                } 
            }
        }
        $this->view('Users/register', $data, $errors);  
    }

    public function login()
    {
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/mypanelcontroller');
        }
       
        if (isset($_POST['login'])) {
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            
            // check if empty or null validation
            //check if valid pass and user
            $errors = []; //save errors here if exists


            //Login
            if (empty($errors)) {
                $this->userModel->email = $data['email'];
                $this->userModel->password = $data['password'];
                $loggedUser = $this->userModel->login();

                if ($loggedUser) {
                    $this->createSession($loggedUser);
                } else {
                    $data['feedback'] = 'Error login credentials.';
                }
            }
        }
        
        $this->view('Users/login', $data = [], $errors = []);  
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        
        header('location: ' . BASE_URL);
    }

    public function createSession($user)
    { 
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['first_name'];
        $_SESSION['user_id'] = $user['id']; 

        var_dump($_SESSION);
    }
}
