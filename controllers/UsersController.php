<?php

class UsersController extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    
    public function login(){
        $data = [
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
       
            if(isset($_POST['register'])){
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailError' => '',
                    'passError' => ''
                ];

                






        
            }

        }








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

                    if($this->userModel->register($data)){

                        //header('location: ' . BASE_URL . '/userscontroller/login' );

                    }else{
                        die('Something went wrong');
                    }

                }else{
                    //dejar valores en los inputs hasta que se introduzcan correctamente.
                }
       
            }
        }

        $this->view('User/register', $data);  
    }




    

} 

?>