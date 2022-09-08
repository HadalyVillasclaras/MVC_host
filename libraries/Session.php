<?php


    session_start();

class Session
{

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }

    public function logout(){
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['user_id']);
        session_destroy();
        // header('location: ' . BASE_URL);
    }
}
