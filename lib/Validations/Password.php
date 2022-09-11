<?php

class Password 
{
    private $password;
    private $errors = [];

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function validatePassword()
    {
        $passPattern = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

        if (empty($this->password)) {
            $this->errors['password'] = 'Field must be filled';
        } elseif (strlen($this->password) < 8){
            $this->errors['password'] = 'Password must be at least 8 characters long';
        } elseif(preg_match($passPattern, $this->password)) {
            $this->errors['password'] = 'Password must have at least one numeric value';
        }
        return $this->errors['password'] ?? '';
    }

    public function validateConfirmPassword($confirmPass) {
        if (empty($confirmPass)) {
            $this->errors['confirmPassword'] = 'Please, repeat your password';
        } elseif ($this->password != $confirmPass) {
            $this->errors['confirmPassword'] = 'Passwords do not match';
        }
        return $this->errors['confirmPassword'] ?? '';
    }

    public function passwordHash() {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            return $this->password;

    }
} 