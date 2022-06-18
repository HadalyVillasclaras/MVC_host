<?php

//clase para invoacr viustas d forma automatica y no con los requires.
    class Views{
        function getView($controller, $view){
            $controller = get_class($controller);
            if($controller == "HomesController"){
                $view = "/views/".$view.".php";
            }else{
                $view = "/views/".$controller."/".$view.".php";
            }
            require_once($view); 
        }
    }

?>