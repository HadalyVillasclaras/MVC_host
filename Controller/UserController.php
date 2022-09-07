<?php

namespace Controller\UserController;

use Controller\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->homeModel = $this->model('Home');
        $this->reservationModel = $this->model('Reservation');
    }
    
    public function login()
    {
        $data = [
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); //sanitize

            var_dump($_POST);
       
            if (isset($_POST['login']))
            {
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailError' => '',
                    'passError' => ''
                ];

                if (empty($data['email'])) 
                {
                    $data['emailError'] = 'Please, enter an email';
                }
     
                if (empty($data['password'])) {
                    $data['passError'] = 'Please, enter a password';
                }
    
                //Login
                if (empty($data['emailError']) && empty($data['passError'])) 
                {
                    $loggedUser = $this->userModel->login($data['email'], $data['password']);
                    var_dump($loggedUser);
                    if ($loggedUser) {
                        echo "loggeado";
                        $this->createSession($loggedUser);
                    } else {
                        $data['passError'] = 'Password or username is incorrect. Please try again.';
                        $this->view('Users/login', $data);
                    }
                }
            }
        }else{
            $data = [
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passError' => ''
            ];
        }
        $this->view('Users/login', $data);  
    }
    
    public function register(){ 
        $data = [
            'name' => '',
            'surname' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'emailError' => '',
            'passError' => '',
            'confirmPassError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
       
            if(isset($_POST['register'])){  
                $data = [
                    'name' => trim($_POST['name']),
                    'surname' => trim($_POST['surname']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirmPassword' => trim($_POST['confirmPassword']),
                    'emailError' => '',
                    'passError' => '',
                    'confirmPassError' => ''
                ];

                // $nameValidation = "/^[a-zA-Z]*$";
                // if (empty($data['name'])){
                //     $data['nameError'] = 'Pleas, enter  name';
                // }elseif(!preg_match($emailValidation, $data['name'])) {
                //     $data['nameError'] = 'Name can only contain numer or letters';
                // }

                //Validate email
                if (empty($data['email'])){
                    $data['emailError'] = 'Please, enter an email';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = 'Please, enter a correct email format';
                }else{
                    //check if email exists
                    if($this->userModel->findUserEmail($data['email'])){
                        $data['emailError'] = 'Email already exists!';
                    }
                }
                

                //Validate password
                $passValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
                if(empty($data['password'])){
                    $data['passError'] = 'Please enter a password';
                }elseif(strlen($data['password']) < 8){
                    $data['passError'] = 'Password must be at least 8 characters';
                }elseif(preg_match($passValidation, $data['password'])) {
                    $data['passError'] = 'Password must have at least one numeric value';
                }

                //Validate confirm password
                if(empty($data['confirmPassword'])){
                    $data['confirmPassError'] = 'Please repeat your password';
                }else{
                    if($data['password'] != $data['confirmPassword']){
                        $data['confirmPassError'] = 'Passwords do not match';
                    }
                }

                //Register
                if(empty($data['passError']) && empty($data['confirmPassError']) && empty($data['emailError'])){
                    //hassh password
                    echo $data['passError'], $data['confirmPassError'], $data['emailError'];
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    $registedUser = $this->userModel->register($data);
                    if($registedUser){
                        //header('location: ' . BASE_URL . '/usercontroller/login' );

                    }else{
                        die('Something went wrong');
                    }

                }else{
                    //dejar valores en los inputs hasta que se introduzcan correctamente.
                }
       
            }
        }

        $this->view('Users/register', $data);  
    }

    public function myPanel(){
        // if(!isLoggedIn()){
        //     header("Location: " . BASE_URL . 'usercontroller/login');
        // }

        $userId = $_SESSION['user_id']; 

        $this->userModel->id  = $userId; 
        $this->reservationModel->userId  =  $userId; 

        $role = $this->userModel->checkRole();

        if($role['role'] == 'Admin'){
            $homes = $this->homeModel->getAll('Homes');   
         
            $this->view('Users/AdminPanel/Homes', $homes); 

            $reservations = $this->reservationModel->getAll('Reservations');   
 

            $this->view('Users/AdminPanel/Reservation', $reservations); 

        }elseif ($role['role'] == 'Guest') { 
            $userInfo = $this->userModel->findUserById();
            $this->view('Users/GuestPanel/index', $userInfo); 
            
            $userReservations = $this->reservationModel->findReservationByUserId();

            $this->view('Users/GuestPanel/reservations', $userReservations); 
        } 
        

    }





    public function createSession($user){ 
        require_once '../libraries/session.php';
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['first_name'];
        $_SESSION['user_id'] = $user['id']; 

        echo "eeeeeeeeeeeeeeeeeeecreateSSession()";
        var_dump($_SESSION);
        // header('location: ' . BASE_URL);
    }
    
    public function logout(){
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['user_id']);
        session_destroy();
        // header('location: ' . BASE_URL);


    }

}
