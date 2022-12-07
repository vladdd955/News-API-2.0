<?php

require_once "vendor/autoload.php";


session_start();


use App\Controllers\ApiController;



$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $rout) {
    $rout->addRoute('GET',"/", [ApiController::class, "index"]);
    $rout->addRoute('GET',"/register", [\App\Controllers\RegisterController::class, "showForm"]);
    $rout->addRoute('POST',"/register", [\App\Controllers\RegisterController::class, "store"]);
    $rout->addRoute('GET',"/authorization", [\App\Controllers\AuthorizationController::class, "authorizationShow"]);
    $rout->addRoute('POST',"/authorization", [\App\Services\RegisterService::class, "checkInLogin"]);
    $rout->addRoute('GET',"/userPage", [\App\Controllers\UserPageController::class, "userPageShow"]);
    $rout->addRoute('POST',"/userPage", [\App\Controllers\ChangeDataController::class, "changeData"]);
    $rout->addRoute('POST',"/changePassword", [\App\Controllers\ChangePasswordController::class, "changePassword"]);
});

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);
$twig->addGlobal('session', $_SESSION);



// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:

        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];

        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];


        [$controller, $method] = $handler;
       $response = (new $controller)->{$method}($vars);


      if ($response instanceof App\Template) {
          echo $twig->render($response->getPath(), $response->getParams());
      }
      if ($response instanceof App\Navigation) {
          header("Location: " . $response->getNavigation());
      }

        break;
}
