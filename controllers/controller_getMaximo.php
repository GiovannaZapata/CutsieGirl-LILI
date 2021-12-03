<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 90%;
  }

  td,
  th {
    border: 1px solid #F5F5F5;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }

  tr.fondo {
    background-color: #F5F5F5;
  }

  .ipanel{
    font-size: 35px;
    margin: 30px;
    color: #797979;
  }
</style>
<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Maximo.php';

$database = new Database();
$db = $database->getConnection();

$maximo = new Maximo($db);
$stmt = $maximo->getMaximo();
?>
<table>
  <tr>
    <td>
      <div style="margin: 10px; padding: 15px; background-color: white; border-radius: 5px;">
        <h5>Venta mas grande registrada</h5><br>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <h6><strong>Usuario que efectuo la venta:</strong> <?php echo $row['nombre']; ?></h6>
        <h6><strong>Fecha: </strong><?php echo $row['fecha']; ?></h6>
        <h6><strong>Venta total: </strong><?php echo $row['maxVenta']; ?></h6>
        <?php
          }
        ?>
      </div>

      <?php
      $minimo = new Maximo($db);
      $auxmin = $minimo->getMinimo();?>
      <hr>
      <div style="margin: 10px; padding: 15px; background-color: white; border-radius: 5px;">
        <h5>Venta más pequeña registrada</h5><br>
        <?php
        while($auxmin2 = $auxmin->fetch(PDO::FETCH_ASSOC)){
        ?>
          <h6><strong>Usuario que efectuo la venta:</strong> <?php echo $auxmin2['nombre']; ?></h6>
          <h6><strong>Fecha:</strong> <?php echo $auxmin2['fecha']; ?></h6>
          <h6><strong>Venta total:</strong><?php echo $auxmin2['minVenta']; ?></h6>
          <br>
      </div>
    </td>
      <?php
      }

      $resurtir= new Maximo($db);
      $aux = $resurtir->getResurtir();
      ?>
    <td>
      <div style="margin: 10px; padding: 40px; background-color: white; border-radius: 5px;">
        <center>
          <h5>Artículos a punto de agotarse en bodega</h5><br>
          <table>
            <tr>
              <th>Nombre del articulo</th>
              <th>Existencia</th>
              <th>Proveedor</th>
              <th>Telefono</th>
            </tr>
        </center>
        <?php
        while ($aux2 = $aux->fetch(PDO::FETCH_ASSOC)) {
        ?>
        </center>
        <tr>
          <td> <?php echo $aux2['nombre']; ?></td>
          <td> <?php echo $aux2['existencia']; ?></td>
          <td> <?php echo $aux2['nomprov']; ?></td>
          <td> <?php echo $aux2['telefono']; ?></td>
        </tr>
        </center>

        <?php
        } 
        ?>
      </div>
      </table>
    </td>
</tr>

<tr class='fondo'>
  <td>
    <?php
      $totalUser = new Maximo($db);
      $auxTotal = $totalUser->getPedidoReciente();
    ?>
    <div style="margin: 10px; padding: 40px; background-color: white; border-radius: 5px;">
      <center>
        <h5>Ventas registradas recientemente</h5><br>
        <table>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Venta total</th>
            <th>idCupon</th>
          </tr>
      </center>
      <?php
        while ($auxTotal2 = $auxTotal->fetch(PDO::FETCH_ASSOC)){
      ?>
      <center>
        <tr>
          <td> <?php echo $auxTotal2['idPedido']; ?></td>
          <td> <?php echo $auxTotal2['nombre_usuario']; ?></td>
          <td> <?php echo $auxTotal2['fecha']; ?></td>
          <td> <?php echo $auxTotal2['venta_total']; ?></td>
          <td> <?php echo $auxTotal2['idCupon']; ?></td>
        </tr>
      </center>
<?php
}
?>
</table>
</div>
</td>

<td>

  <?php
    $eliminado = new Maximo($db);
    $auxEliminado = $eliminado->getArticulosEliminados();
  ?>
  <div style="margin: 10px; padding: 40px; background-color: white; border-radius: 5px;">
    <center>
      <br>
      <h5>Articulos eliminados</h5><br>
      <table>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Marca</th>
          <th>Descripcion</th>
          <th>Proveedor</th>
          <th>Categoria</th>
        </tr>
    </center>
    <?php
      while ($auxEliminado2 = $auxEliminado->fetch(PDO::FETCH_ASSOC)){
    ?>
    <center>
      <tr>
        <td> <?php echo $auxEliminado2['idArticulo']; ?></td>
        <td> <?php echo $auxEliminado2['nombre']; ?></td>
        <td> <?php echo $auxEliminado2['marca']; ?></td>
        <td> <?php echo $auxEliminado2['descripcion']; ?></td>
        <td> <?php echo $auxEliminado2['nomProveedor']; ?></td>
        <td> <?php echo $auxEliminado2['nomCategoria']; ?></td>
      </tr>
    </center>
    <?php
    } 
    ?>
  </table>
  </div>
</td>
</tr>

<tr>
  <td>
    <div style="margin: 10px; padding: 40px; background-color: white; border-radius: 5px;">
    <?php
      $p1 = new Maximo($db);
      $auxp1 = $p1->getP1();
      while ($auxp12 = $auxp1->fetch(PDO::FETCH_ASSOC)){
    ?>
    <h5>Articulos en inventario: <?php echo $auxp12['disponibles']; ?></h5>
    <?php
    }
    ?>
  </td>
  <td>
    <center>
    <i class="fas fa-tshirt ipanel"></i>
    <i class="fas fa-shopping-cart ipanel"></i>
    <i class="fas fa-store ipanel"></i>
    <i class="fas fa-chart-area ipanel"></i>
    </center>
  </td>
</tr>
</table>
</div>