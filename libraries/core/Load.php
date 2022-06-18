<?php
//Load
require_once '../controller/FrontController.php';
$frontController = new FrontController();

$controllerFile = '../controller/'.$controller.'.php'; 
if(file_exists($controllerFile)){
   require_once($controllerFile);
   $controller = new $controller();
   if(method_exists($controller, $method)){
       $controller->{$method}($params);
   }else{ 
    echo "metodo no existe";
    $frontController->errorPage();
   }
}else{
    $frontController->errorPage(); 
    echo "clase no existe";

}

?>