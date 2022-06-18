<?php 
    require_once '../config/parameters.php';
    require_once '../libraries/core/Helpers.php';
    require_once '../views/header.php';
 
     
   if($url = !empty($_GET['url'])){
       $url = $_GET['url'];
   }else{
    $url = 'HomesController/showAllHome';
   }
 
   $arrUrl = explode("/", $url); 
   $controller = $arrUrl[0];
   $method = $arrUrl[0];
   $params = ""; 
    
   if(!empty($arrUrl[1])){
       if($arrUrl[1] != ""){
           $method = $arrUrl[1];
       }
   }

   if(!empty($arrUrl[2])){
       if($arrUrl[2] != ""){
        for ($i=2; $i < count($arrUrl); $i++) { 
           $params .= $arrUrl[$i].',';
        }
        $params = trim($params, ','); 
       }
   } 
   
   
   //autoload
   require_once '../libraries/core/Autoload.php';
   require_once '../libraries/core/load.php';
   
 

//<!----- Footer ---->
    require_once '../views/footer.php'; 
?>
     
    
