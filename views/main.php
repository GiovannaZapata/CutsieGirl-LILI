<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body>

    <div class="presentacion">
        <div class="inicio" style="align-self:center; width: 50%; margin-left: 10%;">
            <h1 style="font-size: 65px;">Cutsie Girl</h1>
            <h2 style="font-family: 'Cookie', cursive;">Dream in color</h2>
        </div>
        <div class="logoInicio" style="width: 50%; text-align: center;">
            <video src="images/logoVideo.mp4" width="80%" autoplay loop></video>
        </div>
    </div>

    <div class="content">
        <div class="card" style="width: 33.33%;">
            <div class="opaco">
                <img src="images/img1.jpg" class="card-img-top" title="Invierno">
            </div>
            <div class="card-body">
                <h5 class="card-title"><i class="far fa-snowflake"></i>  Invierno</h5>

                <p class="card-text">Es una colección que aparece año con año, llena de cosas nuevas y a la moda que seguramente te harán lucir perfecta. <br>
                    Quien dijo que el clima es un impendimento para tener estilo y portarlo a donde quiera que vayas. <br>
                    Visita nuestra colección llena de amor para ti y enamórate de ella.</p>
            </div>
        </div>
        <div class="card" style="width: 33.33%;">
            <div class="opaco">
                <img src="images/img2.jpg" class="card-img-top" title="Vestidos">
            </div>
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-tshirt"></i>  Vestidos</h5>
                <p class="card-text">Tu colección favorita y donde siempre encontrarás lo que buscas. <br>
                    Encuentra aquí un outfit para cualquier ocasión desde lo más casual hasta lo más formal y en cualquiera te hará lucir preciosa. <br>
                    Conoce nuestra coleccion llena de buenas vibras.</p>
            </div>
        </div>
        <div class="card" style="width: 33.33%;">
            <div class="opaco">
                <img src="images/img3.jpg" class="card-img-top" title="Disney">
            </div>
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-child"></i>  Disney</h5>
                <p class="card-text">Nuestra colección especial y única en el mercado. <br>
                    Llego a revolucionar la manera de vestir llevando contigo a tus personajes favoritos de una manera divertida y sin perder el estilo que te caracteriza.</p>
            </div>
        </div>
    </div>
    <div id="cupones">
        <section class="contenedor">
            <br><br>
            <h2 class="centrar-texto">CUPONERA DICIEMBRE</h2>
            <br>
            <h3 class="centrar-texto">Llegaron las ofertas Navideñas</h3>
            <br>
            <div class="centrar-texto">
                <img src="images/CUPONES/propuestas a modificar/Cupon 40off.png" alt="cupón">
            </div>
            <br><br>
            <h3 class="centrar-texto">Suscríbete y obtén tus cupónes con código</h3>
            <br>
            <form method="post">
            <fieldset class="centrar-texto">
                <label style="font-size: 30px;" for="email">E-mail:</label>
                <input class="buu" type="email" id="email" name="email1" placeholder="Tu correo electrónico" required>
            </fieldset>
            <br>
            <input type="submit" value="Suscribirme" name="suscribirme" class="boton boton-azul "><br><br><br>
            <br><br>
            <?php
                include 'php/correoCupon.php';
            ?>
            </form>
        </section>
    </div>
    <!--Si el usuario esta logueado y no es admin va a entrar a la seccion preguntas-->
    <?php
    if (isset($_SESSION['correo']) && $_SESSION['correo'] != 'admin@cutsiegirl.mx') {
    ?>
    <div class="container1">
        <div style="width:100%">
            <h2 style="font-size: 40px; font-weight: bolder; text-align: center;">AYÚDANOS A MEJORAR</h2><br>
            <h3 style="text-align: center;">¡Porque tu opinión nos importa!</h3><br>
        </div>
        <div class="container2">
            <div>
                <img src="images/ayuda.gif" alt="">
            </div>
            <form method="post" class="clasPreg">
                <h4 style="text-align: justify; font-size: 22px;"><b>Contesta estas sencillas preguntas sobre tu experiencia en CutsieGirl</b></h4><br>
                <h5>¿Cómo ha sido tu experiencia en CutsieGirl?</h5>
                <label class="radio-inline">
                    <input type="radio" name="optradio">Buena
                </label>
                <label class="radio-inline">
                    <input type="radio" name="optradio">Mala
                </label>
                <label class="radio-inline">
                    <input type="radio" name="optradio">Regular
                </label>

                <h5>¿Consideras que los precios de los articulos son muy elevados?</h5>

                <label class="radio-inline">
                    <input type="radio" name="optradio1">Si
                </label>
                <label class="radio-inline">
                    <input type="radio" name="optradio1">No
                </label>
                <label class="radio-inline">
                    <input type="radio" name="optradio1">Regular
                </label>

                <h5>¿Es buena la calidad de la ropa?</h5>

                <label class="radio-inline">
                    <input type="radio" name="optradio2">Si
                </label>
                <label class="radio-inline">
                    <input type="radio" name="optradio2">No
                </label>
                <label class="radio-inline">
                    <input type="radio" name="optradio2">Regular
                </label>
                <br><br><br>
                <button style="font-size: 18px; font-weight: bolder; width: 20%;" type="submit" name="enviarP" class="btn btn-primary">Enviar</button>
                <?php 
                    include 'php/correoCuponRegalo.php'; 
                ?>
            </form>
        </div>
    </div>
    <?php } ?>

</body>

</html>