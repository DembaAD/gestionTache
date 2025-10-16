<?php
namespace App;

class Router{
    private array $routes = [];
    
    public function addRoute(Route $route){
        $this->routes[] = $route;
    }
    public function dispatch(string $method, string $uri) {
        foreach ($this->routes as $route) {
            $params = $route->matches($method, $uri);
            if ($params !== false) {
                $handler = $route->getHandler();
                if (is_callable($handler)) {
                    $handler($params); 
                } else {
                    echo $handler;
                }
                return;
            }
    }
    http_response_code(404);
    echo "Page inexistante";
}

}