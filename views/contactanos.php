<div class="titulosPags">
  <span>CONTÁCTANOS</span>
</div>

<div class="contentContac">
    <div class="contactanos">
        <div class="contacto" style="text-align:center;">
            <img src="images/contacto.gif" alt="">
        </div>
        <div class="forms">
            <h6>Por favor, rellene el siguiente formulario y nos pondremos en contacto contigo en breve:</h6>
            <form method="post">
                <br>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="InputNombre" placeholder="Nombre completo">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="InputEmail" aria-describedby="emailHelp" placeholder="Correo electrónico">
                    <small id="emailHelp" class="form-text text-muted">Su correo electrónico no se compartirá con nadie más.</small>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="telefono" id="InputTelefono" placeholder="Teléfono">
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="InputMensaje" name="mensaje" placeholder="Compartános su mensaje" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="enviarContact" onclick="contacto()" style="width:20%; border-radius:15px">Enviar</button>
                <?php
                    include 'php/correo.php';
                ?>
            </form>
            <br><br>
            <h5 style="color: rgb(75, 73, 73);"><b>¿Quieres saber mas sobre nuestros<br>productos?</b></h5><br>
            <b style="color: rgb(75, 73, 73);">¡Llámanos al teléfono!</b>
            <p style="color: rgb(75, 73, 73);">Tel:449-789-65-12</p>
            <b style="color: rgb(75, 73, 73);">Localízanos en:</b><br><br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3702.255485442629!2d-102.29483538599813!3d21.88623548554018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429ee644fd3139d%3A0x586a90fb8f831491!2sZaragoza%20225%2C%20Zona%20Centro%2C%2020000%20Aguascalientes%2C%20Ags.!5e0!3m2!1sen!2smx!4v1606773540684!5m2!1sen!2smx" width="300" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            <br><h6 style="color: rgb(75, 73, 73);">Zaragoza #225, Centro<br>Aguascalientes, Ags, mx.</h6>
        </div>
    </div>
</div>
