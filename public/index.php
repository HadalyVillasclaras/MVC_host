<?php
    require_once '../autoload.php';
    require_once '../views/header.php';

    function showError(){
        $error = new FrontController();
        $error->error404();
    }

//<!----- Homes ---->
    $homes = new HomesController();
    $homes->showAllHome();
 

//<!----- Footer ---->
    require_once '../views/footer.php'; 
?>
     
    
