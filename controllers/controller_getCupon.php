<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Cupon.php';

$database = new Database();
$db = $database->getConnection();

$cupon = new Cupon($db);
$cupon->descripcion = $_POST['descripcion'];

$stmt = $cupon->getCupon();
if($stmt->rowCount() == 0 ) {
    echo 0;
} else {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row['descripcion'] == null)
        echo 0;
    else
        echo $row['porcentaje'];
}
?>