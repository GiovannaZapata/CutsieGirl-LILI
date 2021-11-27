<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_maximo.php';

$database = new Database();
$db = $database->getConnection();

$maximo = new Maximo($db);
$stmt = $maximo->getMaximo();


$row = json_encode($stmt->fetchAll());

echo $row;

//print_r($row);

//echo "$row['precio']";


?>