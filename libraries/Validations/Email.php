<?php

class Email 
{
    private $email;

    function __construct($email)
    {
        $this->email = $email;
    }
    
    function validateEmail()
    {
        $errors = [];

        if (empty($this->email)) {
            $errors['email'] = 'Field must be filled';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Please, enter a correct email format';
        } 

        return $errors;
    }

    public function checkIfEmailExists()
    {

    }
}