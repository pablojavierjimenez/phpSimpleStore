<?php
  header('Content-type: text/html; charset=utf-8');
  header('Content-Type: application/json');

  require_once "./router.php";

  $serverName  = $_SERVER['SERVER_NAME'];
  $request_uri = $_SERVER['REQUEST_URI'];

  router($request_uri, function ($uri) {
    $message = '{"message":"Hubo algun error o no existe fijate"}';
    $uriArray = array_filter( explode('/', trim($uri) ) );
    $uriLostValue = count($uriArray);
    $dbPath = '../db/'.$uriArray[$uriLostValue].'_data_from_csv.json';

    if ( file_exists($dbPath) ) {
      //trigger exception in a "try" block
      require_once $dbPath;
      // echo $dbPath;

    } else {
      echo $message;
    }

  });
