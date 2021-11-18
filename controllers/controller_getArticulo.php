<?php
include_once '../connection/Object_Connection.php';
include_once '../models/Object_Articulo.php';

$database = new Database();
$db = $database->getConnection();

$articulo = new Articulo($db);

$articulo->idCategoria = $_POST['categoria'];
$stmt = $articulo->getArticulo();

if ($stmt->rowCount() > 0) {
    //Card: nombre, marca, descripcion, imagen, talla, color, existencia
    //Venta: idInventario, precio, idCategoria
    //idArticulo
    $rand = rand(0, $stmt->rowCount() - 1);
    $i = 0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="col-3">
            <div class="card" style="width: 18rem; height: 100%;">
                <div class="articulo">
                    <img class="card-img-top imagen" src="<?php echo $row['imagen'] ?>" alt="Card image cap">
                    <div class="overlay">
                        <div class="text" data-toggle="modal" data-target="#modalVistaPrevia<?php echo $i; ?>">Vista Previa</div>
                    </div>
                </div>
                <div class="card-body">
                <?php
                if($i == $rand) {
                    $newPrecio = 0.9 * $row['precio'];?>
                    <h5 class="card-title" style="text-align: center;"><?php echo "$row[nombre] - <del>$$row[precio]</del> - $$newPrecio"; ?></h5>
                <?php
                    $row['precio'] = $newPrecio;
                } else {
                    ?>
                    <h5 class="card-title" style="text-align: center;"><?php echo "$row[nombre] - $$row[precio]"; ?></h5>
                    <?php }
                    if (($_POST['admin']) == 'admin@cutsiegirl.mx') {
                        $admin = "'" . $_POST['admin'] . "'" ?>
                        <div style="display: flex; justify-content: space-between;">
                            <button class="btn btn-info" data-toggle="modal" data-target="#modalEditarArticulo<?php echo $i; ?>" style="border-radius: 15px;">Editar</button>
                            <button class="btn btn-danger" onclick="deleteArticulo(<?php echo $row['idArticulo'] ?>,
                                <?php echo $row['idInventario'] ?>, <?php echo $_POST['categoria'] ?>, <?php echo $admin; ?>)" style="border-radius: 15px;">Eliminar</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--Modal Vista previa-->
        <!--Vista previa: nombre, marca, descripcion, imagen, talla, color, existencia, precio-->
        <div id="modalVistaPrevia<?php echo $i; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content vistaPre">
                    <div class="modal-header">
                        <h3 class="cafe">Vista Previa</h3>
                        <button type="button" class="close font-weight-light" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="vistaPrevia">
                            <div class="col-5">
                                <img src="<?php echo $row['imagen'] ?>" style="float: left; width: 100%;">
                            </div>
                            <div class="col-7 vista2">
                                <div class="nombreArticulo"><?php echo $row['nombre']; ?></div><br>
                                <div class="nombreAPrecio">Precio: $<?php echo $row['precio']; ?></div><br>
                                <div class="nombreMarca">Marca: <?php echo $row['marca']; ?></div><br>
                                <div class="nombreTalla">Talla: <?php echo $row['talla']; ?></div><br>
                                <div class="nombreColor">Color: <?php echo $row['color']; ?></div><br>
                                <div class="nombreCantidad"><label for="cantidadVP">Cantidad:</label></div>
                                <input type="number" class="form-controls" id="cantidadVP<?php echo $i?>" placeholder="Cantidad" value="<?php echo $row['existencia'] > 0? 1 : 0 ?>"
                                    required onchange="validaCantidad(this, $(this).val(),<?php echo $row['existencia']; ?>)" onkeyup="validaCantidad(this, $(this).val(),<?php echo $row['existencia']; ?>)"
                                style="width: 20%;"><br>
                                <div class="nombreDesc"> <?php echo $row['descripcion']; ?></div><br>
                                <button class="btn btn-primary" style="background-color: saddlebrown; border-color:saddlebrown; float:right"
                                onclick="addToCart(<?php echo '\''.$row['nombre'].'\'' ?>,//nombre
                                                   $('#cantidadVP'+<?php echo $i;?>).val(),//cantidad
                                                   <?php echo $row['precio']; ?>,//Precio
                                                   <?php echo '\''.$row['imagen'].'\'' ?>,//Imagen
                                                   <?php echo $row['idCategoria'] ?>,//Cateogria
                                                   <?php echo $row['idInventario'] ?>,/*Inventario*/
                                                   <?php echo $i; ?>)
                                ">Añadir al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal Vista previa-->
        <!--Modal Editar Articulo-->
        <div id="modalEditarArticulo<?php echo $i; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Editar Artículo</h3>
                        <button type="button" class="close font-weight-light" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form class="form" role="form" id="formularioEditarArticulo">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="editarNombre<?php echo $i; ?>" placeholder="Nombre" value="<?php echo $row['nombre'] ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editamarca">Marca:</label>
                                        <input type="text" class="form-control" id="editarMarca<?php echo $i; ?>" placeholder="Marca" value="<?php echo $row['marca'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input type="number" class="form-control" id="editarPrecio<?php echo $i; ?>" placeholder="Precio" min="1" value="<?php echo $row['precio'] ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="color">Existencia:</label>
                                        <input type="number" class="form-control" id="editarExistencia<?php echo $i; ?>" placeholder="Existencia" value="<?php echo $row['existencia'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea name="descripcion" class="form-control" id="editarDescripcion<?php echo $i; ?>" cols="30" rows="2" style="resize: none;" placeholder="Descripcion"><?php echo $row['descripcion'] ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="button" onclick="editArticulo(<?php echo $row['idArticulo'] ?>,<?php echo $row['idInventario'] ?>,
                            <?php echo $_POST['categoria'] ?>, <?php echo '\''.$_POST['admin'].'\'' ?>, '<?php echo $i; ?>')" class="btn btn-success">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Fin Modal Editar Articulo-->
    <?php
    $i++;
    }
} else {
    ?>
    <div class="titulosPags">
        <span style="font-size: 25px;">NO HAY ARTICULOS EN ESTA CATEGORIA</span>
    </div>
<?php
}
?>