<?php

include_once '../connection/Object_Connection.php';
include_once '../models/Object_Inventario.php';
include_once '../models/Object_Articulo.php';

$database = new Database();
$db = $database->getConnection();

$inventario = new Inventario($db);
$articulo = new Articulo($db);

//existencia, precio
$inventario->idInventario = $_POST['idInventario'];
$inventario->precio = $_POST['precio'];
$inventario->existencia = $_POST['existencia'];

echo $inventario->editInventario();

//nombre, marca, descripcion
$articulo->idArticulo = $_POST['idArticulo'];
$articulo->nombre = $_POST['nombre'];
$articulo->marca = $_POST['marca'];
$articulo->descripcion = $_POST['descripcion'];
echo "<br><br>";
echo $articulo->editArticulo();

?>