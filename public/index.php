<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    require_once '../config/parameters.php'; 
    require_once '../controllers/Controller.php';
    require_once '../libraries/Core.php';
    require_once '../libraries/session_helper.php';



    require_once '../views/head.php';
    require_once '../views/navbar.php';

    
 



    $init = new Core();

 
   
 
 
    require_once '../views/footer.php'; 
?>
     
    
