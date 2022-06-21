<?php

class UsersController extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
        
    }
    public function index(){
        echo "Clase UsersController, función index()";
    }
 
    public function login(){
        $data = [
            'emailError' => '',
            'passError' => '',
            'confirmPassError' => ''
        ];

        

        $this->view('User/login', $data);  
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

            //validate email
            if (empty($data['email'])){
                $data['emailError'] = 'Pleas, enter  email';
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Enter a correct format';
            }else{
                //check if email exists
                if($this->userModel->findUserEmail($data['email'])){
                    $data['emailError'] = 'Email already exists!';
                }
 
            }
            

            //validate password
            $passValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
            if(empty($data['password'])){
                $data['passError'] = 'Please enter pass';
            }elseif(strlen($data['password'] < 8)){
                $data['passError'] = 'Password must be at least 8 characters.';
            }elseif(!preg_match($passValidation, $data['password'])) {
                $data['passError'] = 'Password must have at least one numeric value.';
            }

            //validate confirm password
            if(empty($data['confirmPassword'])){
                $data['confirmPassError'] = 'Please enter pass';
            }else{
                if($data['password'] != $data['confirmPassword']){
                    $data['confirmPassError'] = 'Passwords do not match.';
                }
            }

            //make sure errors are empty
            if (empty($data['passError'] && $data['confirmPassError'] && $data['emailError'])){
                //hassh password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->register($data)){
                    echo 'registrado';
                    //redirect logn page
                    //header('location: ' . BASE_URL . '/users/login' );

                }else{
                    die('Something went wrong');
                }

            }
       
        }



        $this->view('User/register', $data);  
    }

    public function signUp(){
        $this->view('User/register');  
    }

    public function saveUser(){

    }
} 

?>