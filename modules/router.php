<?php

/**
 * Holds the registered routes
 *
 * @var array $routes
 */
$routes = [];
$notFound = '{"message":"endpoint not exist"}';
/**
 * Register a new route
 *
 * @param $action string
 * @param \Closure $callback Called when current URL matches provided action
 */
function router($route, $callback)
{
  $callback($route);
    // global $routes;
    // $action = trim($route, '/');
    // $routes[$action] = $callback;
}

/**
 * Dispatch the router
 *
 * @param $action string
 */
function dispatch($requestURI)
{
    global $routes;
    global $notFound;
    $requestURI = trim($requestURI, '/');

    if ( array_key_exists($requestURI, $routes) )
    {
      // echo "Key exists!";
      $callback = $routes[$requestURI];
    }
    else
    {
      // set response code - 404 Not found
      http_response_code(404);
      echo $notFound;
    }

    // set response code - 200 OK
    http_response_code(200);
    // show products data in json format
    // echo json_encode($callback());
    echo $callback();
}

function parceURIvalues()
{
  /**
   * aca tendria qeu parcear las uri en los : (dos puntos)
   * para saber cuando me llega un valor
   * asi con ese valot
  */
}
