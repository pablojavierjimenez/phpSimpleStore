<?php

require_once "../modules/router.php";

$request_uri = $_SERVER['REQUEST_URI'];
router($request_uri, function ($uri) {

  $uriArray = array_filter( explode('/', trim($uri) ) );
  $uriLostValue = count($uriArray);
  $dbPath = '../db/'.$uriArray[$uriLostValue].'_data_from_csv.php';
  require_once $dbPath;

  echo json_encode($j);

  // $message = '{"message":"'.$uriLostValue.'"}';
  // return $uriArray;
});


// dispatch($request_uri);
