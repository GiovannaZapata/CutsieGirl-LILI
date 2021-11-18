<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Grafica.php';

$database = new Database();
$db = $database->getConnection();

$grafica = new Grafica($db);
$stmt = $grafica->getGrafica();

$row = json_encode($stmt->fetchAll());

print_r($row);
?>