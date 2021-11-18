<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Carrito.php';
include_once '../models/Object_Inventario.php';
include_once '../models/Object_Venta.php';

$database = new Database();
$db = $database->getConnection();

$carrito = new Carrito($db);
$inventario = new Inventario($db);
$venta = new Venta($db);

$stmt = $carrito->getCarrito();

$venta->idNota = $_POST['idNota'];

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $venta->idInventario = $row['idInventario'];
    $venta->cantidad = $row['cantidad'];
    $venta->precio_venta = $row['precio'];
    $venta->idCategoria = $row['idCategoria'];

    $venta->addVenta();

    $inventario->idInventario = $row['idInventario'];
    $inventario->cantidad = $row['cantidad'];
    $inventario->updateInventario();
}

?>