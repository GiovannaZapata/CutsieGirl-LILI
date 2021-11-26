
<div class="titulosPags">
    <span style="font-size: 25px;">FINALIZAR COMPRA</span>
</div>

<body onload="getCartFinal(), updateCarrito()">
    <div class="contentfinCompra">
    <div id="productosCarritoFinal">

        <form style="width:50%; padding-right: 20px;">
            <h5>Datos de envio</h5>
            <p  class="form-text text-muted">*Todos los campos son obligatorios</p>
           <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nombreCompleto" placeholder="Nombre completo" name="nombreCompleto" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="direccionVta" placeholder="Dirección" name="direccion" required>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <select id="inputState" class="form-control">
                            <option value="Aguascalientes" selected>Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Estado de México">Estado de México</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                        </select>
                    </div>
                </div>

                <div class="col-4">
                   <div class="form-group">
                        <input type="text" class="form-control" id="municipio" placeholder="Municipio" name="municipio" required>
                    </div>
                </div>

                <div class="col-3">
                   <div class="form-group">
                        <input type="number" class="form-control" id="codpostal" placeholder="C.P" name="codpostal" required>
                    </div>
                </div>
            </div>

            <h5>Método de pago</h5>
            <nav style="width:90%;">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tarjeta de crédito</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pago en efectivo</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div id="md1">
                        <p>Selecciona tu tarjeta</p>   
                        <input type="radio" name="type" id="visa" value="tarjeta">
                        <label for="visa"><img src="images/visa.png" alt="" height="25" width="40"></label>
                        <input type="radio" name="type" id="am" value="tarjeta">
                        <label for="am"><img src="images/amex.png" alt="" width="40" height="35"></label>
                        <input type="radio" name="type" id="mast" value="tarjeta">
                        <label for="mast"><img src="images/ms.png" alt="" width="40" height="25"></label>
                    </div><br>
                    <div class="form-row">
                        <div class="col-4">
                            <label for="number">Número de tarjeta</label>
                        </div>
                        <div class="col-8">
                            <input type="number" id="number" name="number" class="form-control" placeholder="1234-5678-9012-3456">
                        </div>
                    </div><br>

                    <div class="form-row">
                        <div class="col-4">
                            <label for="name">Nombre del titular</label>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="text" name="name" id="name" placeholder="Como aparece en la tarjeta">
                        </div>
                    </div><br>

                    <div class="form-row">
                        <div class="col-5">
                            <label for="security">Código de seguridad</label>
                        </div>
                        <div class="col-7">
                            <input class="form-control" type="password" name="security" id="security" placeholder=" • • • " style="width:80px">
                        </div>
                    </div>           
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <p>Selecciona la sucursal</p>   
                    <input type="radio" name="type" id="oxxo" value="oxxo">
                    <label for="oxxo"><img src="images/oxxo.jpg" alt="" height="35" width="40"></label>
                    <input type="radio" name="type" id="farmacia" disabled>
                    <label for="farmacia"><img src="images/farmacia.jpg" alt="" height="25" width="55"></label>
                    <input type="radio" name="type" id="benavides" disabled>
                    <label for="benavides"><img src="images/benavides.PNG" alt="" height="25" width="55"></label>
                    <div style="padding-left:10px; padding-right:10px">
                        <p>1. Menciona al empleado que quieres pagar un servicio de CutsieGirl.</p>
                        <span>2. Muestrale este código QR al cajero para que lo escanee y listo.</span>
                    </div>
                    <center><img src="images/codigoqr.png" alt=""></center>
                </div>
            </div>

            <!--Gastos de envío esto va al controlador-->
            <?php
            //temporal
            $subtotal = 50;
            //fin temporal
            $costoenvio =0;
            if($subtotal > 2000){
                $costoenvio=0;
            }else{
                $costoenvio=200;
            }
            $total= $costoenvio + $subtotal;
            ?>

            <div class="form-group">
                <p><b>¿Tienes un cupón de descuento?</b></p>
                <label for="cupon"><b>Ingresa su código aquí</p></label>
                <input class="form-control" type="text" id="cupon" name="cupon" placeholder="CUTSIEXXXX" style="width:200px;">   
            </div><br>
            <?php
                $user = "'".$_SESSION['nombreUsuario']." ".$_SESSION['apellidos']."'";
                $idUsuario = "'".$_SESSION['idUsuario']."'";
            ?>
            <button type="button" class="btn btn-primary"onclick="finalizarCompra(<?php echo $user; ?>,<?php echo $idUsuario; ?>)" name="continuar">Continuar</button>
        </form>

    </div>

    </div>
            
