<?php

class IndexController extends Controller
{      
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = $this->model('Home');
    }

    public function index()
    {
        $allHomes = $this->homeModel->getAll();  
        $this->view('Index/Home', $allHomes);
    }
}