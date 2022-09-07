<?php


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    class IndexController extends Controller
    {      
        public function __construct()
        { 
        }
        private $table = 'Homes';

        public function index()
        { 

            var_dump($_SESSION);
            $this->view('Index/main');
            $this->model('Home'); 

            $home = new Home();

            $homes = $home->getAll($this->table);  
            $this->view('Home/homes', $homes); 
        }
    }


?>