<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Cupon.php';
include_once '../models/Object_Nota.php';

$database = new Database();
$db = $database->getConnection();

$cupon = new Cupon($db);
$cupon->descripcion = $_POST['descripcion'];

$nota = new Nota($db);

$stmt = $cupon->getCupon();
if($stmt->rowCount() == 0 ) {
    $nota->idCupon = 0;
} else {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['descripcion'] == null)
        $nota->idCupon = 0;
    else
        $nota->idCupon = $row['idCupon'];
}

$nota->fecha = date('Y-m-d');
$nota->idUsuario = $_POST['idUsuario'];
$nota->venta_total = $_POST['total'];

echo $nota->addNota();

?>