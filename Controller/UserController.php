<?php
require_once '../libraries/session.php';
require_once '../libraries/Validations/Password.php';
require_once '../libraries/Validations/Email.php';

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
        $data = [
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); //sanitize
       
            if (isset($_POST['login'])) {
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password'])
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

    public function myPanel(){
        if (!$this->isLoggedIn->isLoggedIn()) {
            header("Location: " . BASE_URL . 'usercontroller/login');
        }

        $userId = $_SESSION['user_id']; 
        $this->userModel->id  = $userId; 
        $role = $this->userModel->checkRole();

        $this->reservationModel->userId  =  $userId; 

        if($role['role'] == 'Admin'){
            $data['homes'] = $this->homeModel->getAll('Homes');   
            $data['reservations'] = $this->reservationModel->getAll('Reservations');   
            $data['userInfo'] = $this->userModel->findUserById();

            $this->view('Users/AdminPanel/Index', $data); 

        }elseif ($role['role'] == 'Guest') { 
            $data['userInfo'] = $this->userModel->findUserById();
            $data['userReservations'] = $this->reservationModel->findReservationByUserId();

            $this->view('Users/GuestPanel/Index', $data); 
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
    


}
