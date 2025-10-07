<?php
namespace App;

class Route {
    private string $method;
    private string $path;
    /** @var string|callable */
    private $handler;

    public function __construct(string $method, string $path, callable|string $handler)
    {
        $this->method = strtoupper($method); 
        $this->path = $path;
        $this->handler = $handler;
    }

   public function matches(string $method, string $uri): array|false
{
    // 1. Vérifier que la méthode est bonne
    if ($this->method !== strtoupper($method)) {
        return false;
    }

    // 2. Transformer le path avec {param} en regex
    $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $this->path);
    $pattern = '#^' . $pattern . '$#';

    // 3. Tester l’URI avec la regex
    if (preg_match($pattern, $uri, $matches)) {
        array_shift($matches); // on enlève la correspondance complète
        return $matches; // retourne uniquement les paramètres
    }

    return false;
}


    public function getHandler(): string | callable
    {
        return $this->handler;
    }
}
