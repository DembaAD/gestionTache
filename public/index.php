<?php
require '../vendor/autoload.php';

use App\Controller\TaskController;
use App\Route;
use App\Router;


$router = new Router();
$router->addRoute(new Route('GET','/',function(){
   (new TaskController())->index();
}));
$router->addRoute(new Route('POST','/',function(){
   (new TaskController())->index();
}));
$router->addRoute(new Route('GET','/create',function(){
   (new TaskController())->create();
}));
$router->addRoute(new Route('POST','/create',function(){
   (new TaskController())->create();
}));
$router->addRoute(new Route('POST','/delete',function(){
   
   (new TaskController())->delete();
}));

$router->addRoute(new Route('GET','/edit', function(){
   $id  = $_GET['id'] ?? null;
   if(!$id){
      echo "Id manquant";
   }
   else{
      (new TaskController())->edit((int)$id);
   }
}));
$router->addRoute(new Route('POST','/edit', function(){
   $id  = $_GET['id'] ?? null;
   if(!$id){
      echo "Id manquant";
   }
   else{
      (new TaskController())->edit((int)$id);
   }
}));

$router->addRoute(new Route('GET','/delete',function(){
   $id = $_GET['id'] ?? null;
   if(!$id){
      echo "Id manquant";
   }
   else{
      (new TaskController())->delete((int)$id);
   }

}));
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
