<?php 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../config/parameters.php'; 
require_once '../controller/Controller.php';
require_once '../lib/Router.php';
require_once '../lib/session.php';

require_once '../view/head.php';
require_once '../view/navbar.php';

new Router();

require_once '../view/footer.php';