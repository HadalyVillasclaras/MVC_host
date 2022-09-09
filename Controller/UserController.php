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
        //Si ya está loggeado, header location to my panel
       
        if (isset($_POST['login'])) {
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password'])
            ];
            
            // check if empty or null validation
            //check if valid pass and user
            $errors = [] //save errors here if exists

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
        
        $this->view('Users/login', $data, $errors);  
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
            //check if email exists
            // if($this->userModel->findUserEmail($data['email'])){
            //     $errors['email'] = 'Email already exists!';
            // }

            //Validate password & confirm password
            $passwordValidation =  new Password($data['password']);
            $errors['password'] = $passwordValidation->validatePassword();
            $errors['confirmPassword'] = $passwordValidation->validateConfirmPassword($data['confirmPassword']);

            
            // var_dump(count($errors));
            //$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //Register
            if (count($errors) === 0) {
                $this->userModel->register($data);
                $data['feedBack'] = "User registered.";

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

        } elseif ($role['role'] == 'Guest') { 
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
