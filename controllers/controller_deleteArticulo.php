<?php

include_once '../connection/Object_Connection.php';
include_once '../models/Object_Inventario.php';
include_once '../models/Object_Articulo.php';

$database = new Database();
$db = $database->getConnection();

$inventario = new Inventario($db);
$articulo = new Articulo($db);

$inventario->idInventario = $_POST['idInventario'];

echo $inventario->deleteInventario();

$articulo->idArticulo = $_POST['idArticulo'];

echo $articulo->deleteArticulo();

?>