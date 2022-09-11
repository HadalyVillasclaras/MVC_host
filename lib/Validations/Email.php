<?php

class Email 
{
    private $email;
    private $errors = [];
    public function __construct($email)
    {
        $this->email = $email;
    }
    
    public function validateEmail()
    {

        if (empty($this->email)) {
            $this->errors['email'] = 'Field must be filled';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = 'Please, enter a correct email format';
        } 

        return $this->errors['email'] ?? '';
    }

    public function checkIfEmailExists()
    {

    }
}