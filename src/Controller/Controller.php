<?php
namespace App\Controller;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class Controller {
    protected Environment $twig;
    protected string $storage_type;

    public function __construct()
    {
      
        $loader = new FilesystemLoader(dirname(__DIR__) . '\\Views');
        $this->twig = new Environment($loader, [
            'cache' => false, 
        ]);
    }

    public function render(string $name, array $context = [])
    {
        echo $this->twig->render($name, $context);
    }
}
