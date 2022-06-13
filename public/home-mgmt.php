
<?php
    require_once '../autoload.php';
    require_once '../views/header.php'; 



    $homes = new HomesController();
    $homes->showAllMgmt();




    require_once '../views/footer.php'; 
?>