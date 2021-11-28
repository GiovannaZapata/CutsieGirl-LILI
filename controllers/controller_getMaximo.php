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
include_once '../models/Object_Maximo.php';

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
<br><br><h5>Usuarios registrados</h5><br>
<table>
<tr>
    <th>Id Usuario</th>
    <th>Nombre</th>
    <th>Fecha de registro</th>
    <th>Acción</th>
  </tr>
<?php
while ($auxTotal2 = $auxTotal->fetch(PDO::FETCH_ASSOC)){
  ?>
    <tr>
    <td> <?php echo $auxTotal2['idUsuario']; ?></td>
    <td> <?php echo $auxTotal2['nombre']; ?></td>
    <td> <?php echo $auxTotal2['fecha']; ?></td>
    <td> <?php echo $auxTotal2['accion']; ?></td>
    </tr>
    <?php
}
?>
</table>


<?php

$eliminado = new Maximo($db);
$auxEliminado = $eliminado->getArticulosEliminados();
?>
<br><br><h5>Articulos eliminados recientemente</h5><br>
<table>
<tr>
    <th>Id Articulo</th>
    <th>Nombre</th>
    <th>Marca</th>
    <th>Descripcion</th>
    <th>Proveedor</th>
    <th>Categoria</th>
  </tr>
<?php

while ($auxEliminado2 = $auxEliminado->fetch(PDO::FETCH_ASSOC)){
  ?>
    <tr>
    <td> <?php echo $auxEliminado2['idArticulo']; ?></td>
    <td> <?php echo $auxEliminado2['nombre']; ?></td>
    <td> <?php echo $auxEliminado2['marca']; ?></td>
    <td> <?php echo $auxEliminado2['descripcion']; ?></td>
    <td> <?php echo $auxEliminado2['nomProveedor']; ?></td>
    <td> <?php echo $auxEliminado2['nomCategoria']; ?></td>
    </tr>
    <?php
}
?>
</table>
