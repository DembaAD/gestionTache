<?php
namespace App\Controller;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class Controller {
    protected Environment $twig;
    protected string $storage_type;

    public function __construct()
    {
        // On définit le dossier "Views" comme racine des templates
        $loader = new FilesystemLoader(dirname(__DIR__) . '\\Views');
        $this->twig = new Environment($loader, [
            'cache' => false, // mettre un dossier ici si tu veux activer le cache
        ]);
    }

    /**
     * Render un template Twig
     * @param string $name Nom du template relatif au dossier Views
     * @param array $context Variables à passer au template
     */
    public function render(string $name, array $context = [])
    {
        echo $this->twig->render($name, $context);
    }
}
