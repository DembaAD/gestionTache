<?php
namespace App\Controller;

abstract class Controller{
    protected $twig;
    protected $storage_type;

    public function __construct()
    {
        $loader     = new \Twig\Loader\FilesystemLoader(dirname(__DIR__), '/Views');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
    }

    public function render(string $name,array $context){
        echo $this->twig->render($name,$context);
    }
}