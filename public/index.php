<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../config/parameters.php'; 
require_once '../controller/Controller.php';
require_once '../libraries/Core.php';
require_once '../libraries/session_helper.php';
require_once '../view/head.php';
require_once '../view/navbar.php';

$init = new Core();

require_once '../view/footer.php';