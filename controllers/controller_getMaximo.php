<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_maximo.php';

$database = new Database();
$db = $database->getConnection();

$maximo = new Maximo($db);
$stmt = $maximo->getMaximo();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>

<h6>Nombre del articulo: <?php echo $row['nombre']; ?></h6>
<h6>Inversion: <?php echo $row['mul']; ?></h6><br>
<?php
}


?>