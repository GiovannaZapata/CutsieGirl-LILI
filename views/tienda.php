<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    tr.fondo{
  background-color: white;
}
</style>
<?php $_GET['cat'] = isset($_GET['cat']) && $_GET['cat'] != '' && $_GET['cat'] > 0 && $_GET['cat'] < 4 ? $_GET['cat'] : '1';
$admin = isset($_GET['admin']) ? base64_decode($_GET['admin']) : '0';
$admin = "'" . $admin . "'";
include_once './connection/Object_Connection.php';
include_once './models/Object_Maximo.php';

$database = new Database();
$db = $database->getConnection();

?>

<body onload="getArticulo(<?php echo $_GET['cat']; ?>, <?php echo $admin; ?>), verGrafica(), getMaximo()">

    <div class="titulosPags">
        <?php
        switch ($_GET['cat']) {
            case '1':
                echo "<span>INVIERNO</span>";
                break;
            case '2':
                echo "<span>VESTIDOS</span>";
                break;
            case '3':
                echo "<span>DISNEY</span>";
                break;
        }
        ?>
    </div>
    <div class="row" id="patas1" style="padding: 30px; width: 100%; margin: auto;"></div>
    </div>
    <br>

    <?php
    //Si el que esta logueado es el admin nos dará la opción de modificar la tienda
    if (isset($_SESSION['correo']) && $_SESSION['correo'] == 'admin@cutsiegirl.mx') { ?>
    <!--Modal-->
    <div id="modalAddArticulo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Registro Artículo</h3>
                    <button type="button" class="close font-weight-light" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form class="form" role="form" id="formularioAddArticulo">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombreArticulo" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="marca">Marca:</label>
                                    <input type="text" class="form-control" id="marca" placeholder="Marca">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="from-group">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Proveedor
                                        </button>
                                        <div class="dropdown-menu" id="listProveedores">
                                        </div>
                                        <input type="text" class="form-control" name="idProveedor" id="idProveedor"
                                            placeholder="Proveedor" data-idproveedor="0" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Categoría
                                        </button>
                                        <div class="dropdown-menu" id="listaCategorias">
                                        </div>
                                        <input type="text" class="form-control" name="idCategoria" id="idCategoria"
                                            placeholder="Categoria" data-idCategoria="" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="2"
                                style="resize: none;" placeholder="Descripcion"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <!--existencia, talla, precio, color, imagen-->
                                    <label for="existencia">Existencia:</label>
                                    <input type="number" class="form-control" id="existencia" placeholder="Existencia"
                                        min="1" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="talla">Talla:</label>
                                    <!--<input type="number" class="form-control" id="talla" placeholder="Talla" min="1" required>-->
                                    <select class="form-control" id="talla">
                                        <option title="EXTRA CHICO">XS</option>
                                        <option title="CHICO">S</option>
                                        <option title="MEDIANO">M</option>
                                        <option title="GRANDE">L</option>
                                        <option title="EXTRA GRANDE">XL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="precio">Precio:</label>
                                    <input type="number" class="form-control" id="precio" placeholder="Precio" min="1"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="color">Color:</label>
                                    <input type="text" class="form-control" id="color" placeholder="Color">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="file" class="form-control" name="image" id="image">

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <button type="button"
                                    onclick="addArticulo(<?php echo $_GET['cat'] ?>, <?php echo $admin; ?>)"
                                    class="btn btn-success" style="border-radius: 15px;">Añadir Articulo</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Fin poner modal-->
    <div class="botonAddArticulo">
        <button type="button" class="btn btn-primary btn-agrega" data-toggle="modal" data-target="#modalAddArticulo"
            onclick="$('#formularioAddArticulo').trigger('reset')" style="border-radius: 15px;">Nuevo artículo</button>
    </div><br>


    <!-- Panel de administrador -->
    <hr><br>
    <div class="graficaProveedores">
        <h3>Panel de administración</h3><br><br>
        <div class="row">
            <div class="col">
                <h5>Prendas por proveedor</h5>
                <center>
                    <div id="grafica" onload="verGrafica()"></div>
                </center>
            </div>
        </div><br><br>
        <div class="row">
        <div class="col">
                <center>
                    <div id="maximo" onload="getMaximo()"></div>
                </center>
            </div>
        </div>
        <center>
<table>
    <tr>
        <td>
        
                
                <center>
                        <?php
                           $p2 = new Maximo($db);
                            $auxp = $p2->busquedaArticulo();
                        ?>
                        <h5>Productos con precio mayor a $200.</h5>
                    <table width="50%">
                        <tr>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Existencia</th>
                            <th>Precio</th>
                        </tr>
                        <?php
                           while ($auxprueba = $auxp->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <tr>
                            <td> <?php echo $auxprueba['nombre']; ?></td>
                            <td> <?php echo $auxprueba['marca']; ?></td>
                            <td> <?php echo $auxprueba['existencia']; ?></td>
                            <td> <?php echo $auxprueba['precio']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </center>
                 
            
            </td>
                        <td>
            <div class="col">
                <center>
                    <br>
                <form>
                    <label for="nombre">Ingresa nombre de proveedor a buscar: </label>
                    <input type="text" name="nombreProveedor" id="nombreProveedor" required="required">
                    <input type="button" id="botonBuscarProveedor" value="Buscar"><br><br>
                    <div id="respuesta"></div>
                </form>

                <script>
                    $('#botonBuscarProveedor').click(function () {
                        var nombreProveedor = document.getElementById('nombreProveedor').value;
                        var ruta = "nombreProveedor=" + nombreProveedor;

                        $.ajax({
                                url: "./models/Object_Procedure.php",
                                type: "POST",
                                data: ruta,
                            })
                            .done(function (res) {
                                $('#respuesta').html(res)
                            })
                            .fail(function () {
                                console.log("error");
                            })
                            .always(function () {
                                console.log("complete");
                            });

                    });
                </script>
            
                </center>
            
            
        <br><br><br>

        <center>

                <form>
                    <label for="nameArticulo">Ingresa nombre de articulo a buscar: </label>
                    <input type="text" name="nameArticulo" id="nameArticulo" required="required">
                    <input type="button" id="botonBuscarArticulo" value="Buscar"><br><br>
                    <div id="resultadoArticulo">
                </form>
                </center>
                <script>
                    $('#botonBuscarArticulo').click(function () {
                        var nameArticulo = document.getElementById('nameArticulo').value;
                        var ruta = "nameArticulo=" + nameArticulo;

                        $.ajax({
                                url: "./models/Object_ConsultarArticulo.php",
                                type: "POST",
                                data: ruta,
                            })
                            .done(function (res) {
                                $('#resultadoArticulo').html(res)
                            })
                            .fail(function () {
                                console.log("error");
                            })
                            .always(function () {
                                console.log("complete");
                            });
                    });
                </script>                
            
        
        </td>
                </tr>
                <tr class='fondo'><td>
                <center>
                <input type="button" id="botonVistaArticulo" value="Ver Articulos de inventario"><br><br>
                <div id="resultadoVistaArticulo"></div>
                </center>
                <script>
                    $('#botonVistaArticulo').click(function () {

                        $.ajax({
                                url: "./models/Object_VistaArticulo.php",
                            })
                            .done(function (res) {
                                $('#resultadoVistaArticulo').html(res)
                            })
                            .fail(function () {
                                console.log("error");
                            })
                            .always(function () {
                                console.log("complete");
                            });
                    });
                </script>
            
</td>
<td>
<center>
    <br><br>
            <input type="button" id="botonVistaUsuario" value="Ver Relacion Usuario-Pedido"><br><br>
                <div id="resultadoVistaUsuario"></div><br><br><br>
                </center>
                <script>
                    $('#botonVistaUsuario').click(function () {

                        $.ajax({
                                url: "./models/Object_VistaUsuario.php",
                            })
                            .done(function (res) {
                                $('#resultadoVistaUsuario').html(res)
                            })
                            .fail(function () {
                                console.log("error");
                            })
                            .always(function () {
                                console.log("complete");
                            });
                    });
                </script>
            

    
        </td></tr>
        </table>
                </center>
    <?php
    }
    if (isset($_SESSION['correo']) && $_SESSION['correo'] != 'admin@cutsiegirl.mx') {
    ?>
    <br>
    <div id="fondocupon">
        <br>
        <br>
        <h1 class="centrar-texto">NOS ENCANTA CONSENTIRTE, ASÍ QUE...</h1>
        <br>
        <h4 style="text-align: center;">Usa el código del siguiente cupón en tus compras para tener descuentos
            especiales.</h4>
        <br>
        <div class="centrar-texto">
            <img src="images/CUPONES/propuestas a modificar/3 cupon cutsiecolors.png" alt="cupón">
        </div>
        <br><br>
    </div>
    <?php } ?>
</body>