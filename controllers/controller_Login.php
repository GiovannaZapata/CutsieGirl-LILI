<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Login.php';

$database = new Database();
$db = $database->getConnection();

$login = new Login($db);

$login->correo = $_POST['correo'];
$login->contra = $_POST['contra'];
$login->bloqueo = 0;

echo $login->login();//retorna detalle de ingreso o error :v
?>