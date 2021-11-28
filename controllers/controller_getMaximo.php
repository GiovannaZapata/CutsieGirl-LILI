<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 90%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
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
<h6>Inversion: <?php echo $row['mul']; ?></h6><br><?php
}

$minimo = new Maximo($db);
$auxmin = $minimo->getMinimo();?>
<h5>Compra más pequeña</h5>
<?php
while($auxmin2 = $auxmin->fetch(PDO::FETCH_ASSOC)){
  ?>
  <h6>Cantidad: <?php echo $auxmin2['cantidad']; ?></h6>
<h6>Al Proveedor: <?php echo $auxmin2['nombre']; ?></h6>
<h6>Fecha: <?php echo $auxmin2['fecha']; ?></h6>
<br><?php
}

$resurtir= new Maximo($db);
$aux = $resurtir->getResurtir();
?><h5>A punto de agotarse en bodega.</h5><br>
<table>
<tr>
    <th>Nombre del Articulo</th>
    <th>Existencia</th>
    <th>Proveedor</th>
    <th>Telefono</th>
  </tr>
<?php
while ($aux2 = $aux->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <tr>
    <td> <?php echo $aux2['nombre']; ?></td>
    <td> <?php echo $aux2['existencia']; ?></td>
    <td> <?php echo $aux2['nomprov']; ?></td>
    <td> <?php echo $aux2['telefono']; ?></td>
    </tr>

<?php
} 
?>
</table>



<?php
$totalUser = new Maximo($db);
$auxTotal = $totalUser->getAuditoria();

?>