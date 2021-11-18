<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Categoria.php';

$database = new Database();
$db = $database->getConnection();

$categoria = new Categoria($db);

$stmt = $categoria->getCategoria();
$i = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <button class="dropdown-item" type="button" onclick="cambioCategoria(this)" data-idcategoria="<?php echo $row['idCategoria'] ?>"><?php echo $row['nombre'] ?></button>
<?php

}
?>