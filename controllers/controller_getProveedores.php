<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Proveedor.php';

$database = new Database();
$db = $database->getConnection();

$proveedor = new Proveedor($db);

$stmt = $proveedor->getProveedor();
$i = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <button class="dropdown-item" type="button" onclick="cambioProveedor(this)" data-idproveedor="<?php echo $row['idProveedor'] ?>"><?php echo $row['nombre'] ?></button>
<?php
}
?>