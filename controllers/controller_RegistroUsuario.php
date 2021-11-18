<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Login.php';

$database = new Database();
$db = $database->getConnection();

$login = new Login($db);

$login->nombre = $_POST['nombre'];
$login->apellido_paterno = $_POST['apellido_paterno'];
$login->apellido_materno = $_POST['apellido_materno'];
$login->correo = $_POST['correo'];
$login->contra = $_POST['password'];
//
$login->colonia = $_POST['colonia'];
$login->cp = $_POST['cp'];
$login->calle = $_POST['calle'];
$login->numero = $_POST['numero'];
//
$login->bloqueo = 0;

echo $login->setRegistro();//retorna ultimo id insertado
?>