<?php
header('Content-type: text/html; charset=utf-8');
header('Content-Type: application/json');
include('get_data_from_csv.php');

$uploaded_file = $_FILES["archivo"];
$family_name = $_POST['familia'];
list($csv_headers,$row_data, $stock) = getDataFromCSV::csvToElementList($uploaded_file);
$tabla  = getDataFromCSV::csvToTable($csv_headers, $row_data);
$json   = getDataFromCSV::csvToJSON($row_data, $stock, $family_name);

$nombre = $family_name;
$phpfile_output = "../db/${nombre}_data_from_csv.json";

file_put_contents($phpfile_output, $json);

echo $json;
