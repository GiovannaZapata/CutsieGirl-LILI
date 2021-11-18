<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Carrito.php';

$database = new Database();
$db = $database->getConnection();

$carrito = new Carrito($db);

$stmt = $carrito->getCarrito();

if ($stmt->rowCount() > 0) {
    //idCarrito, idInventario, idCategoria
    //nombre, precio, imagen
    $subtotal = 0;
    $categorias = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="articulo">
            <div class="card">
                <div class="card-body">
                <img class="card-img-top imgCarrito" src="<?php echo $row['imagen'] ?>" alt="Card image cap" style="height: 150px; width: 80px; float: left;">
                <button type="button" class="close font-weight-dark" onclick="dropCart(<?php echo $row['idCarrito'] ?>)">×</button>
                <br>
                <h5 class="card-title" style="text-align: center;"><?php echo "$row[nombre]"; ?></h5>
                <br>
                <h5 class="card-title" style="text-align: center;"><?php echo "$$row[precio]<br>$row[cantidad] unidad(es)"; ?></h5>
                </div>
            </div>
        </div>
        <!--Modal Vista previa-->
        <!--Vista previa: nombre, marca, descripcion, imagen, talla, color, existencia, precio-->
    <?php
    $subtotal += ($row['precio'] * $row['cantidad']);
    
    }?>
    <div class="titulosPags">
        <span style="font-size: 25px;">SUBTOTAL: $<?php echo $subtotal?></span>
    </div>
    <?php
} else {
    ?>
    <div class="titulosPags">
        <span style="font-size: 25px;">CARRITO VACÍO</span>
    </div>
<?php
}
?>