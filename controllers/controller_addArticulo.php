<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Articulo.php';
include_once '../models/Object_Inventario.php';
include_once '../models/Object_Compra.php';

$database = new Database();
$db = $database->getConnection();

$articulo = new Articulo($db);
$inventario = new Inventario($db);
$compra = new Compra($db);

$articulo->nombre = $_POST['nombre'];
$articulo->marca = $_POST['marca'];
$articulo->descripcion = $_POST['descripcion'];
$articulo->idProveedor = $_POST['idProveedor'];
$articulo->idCategoria = $_POST['idCategoria'];

$idArticulo = $articulo->addArticulo();//retorna ultimo id insertado

$inventario->idArticulo = $idArticulo;
$inventario->existencia = $_POST['existencia'];
$inventario->talla = $_POST['talla'];
$inventario->status = 1;
$inventario->precio = $_POST['precio'];
$inventario->imagen = $_POST['imagen'];
$inventario->color = $_POST['color'];

$idInventario = $inventario->addInventario();

$compra->idProveedor = $_POST['idProveedor'];
$compra->idInventario = $idInventario;
$compra->fecha = date('Y-m-d');
$compra->cantidad = $_POST['existencia'];

echo $compra->addCompra();

echo $idArticulo;

?>