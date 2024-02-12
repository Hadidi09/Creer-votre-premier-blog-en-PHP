<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{

    private $loader;
    protected $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT . '/blog-php/templates');
        $this->twig = new Environment($this->loader);
    }

    protected function renderTwigView($view, $data = [])
    {
        echo $this->twig->render($view, $data);
    }
}
