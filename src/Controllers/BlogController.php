<?php

namespace App\Controllers;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class BlogController extends Controller
{


    public function __construct()
    {
        parent::__construct();
    }

    public function homePage()
    {
        $this->twig->display('main/acceuil.html.twig');
    }
}
