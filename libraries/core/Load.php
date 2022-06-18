<?php
//Load
require_once '../controller/FrontController.php';
$frontController = new FrontController();

$controllerFile = '../controller/'.$controller.'.php';
echo $controllerFile;
if(file_exists($controllerFile)){
   require_once($controllerFile);
   $controller = new $controller();
   if(method_exists($controller, $method)){
       $controller->{$method}($params);
   }else{ 
    $frontController->errorPage();
   }
}else{
    $frontController->errorPage(); 
}

?>