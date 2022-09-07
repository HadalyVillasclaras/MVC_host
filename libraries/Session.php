<?php
namespace libraries;

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
}
