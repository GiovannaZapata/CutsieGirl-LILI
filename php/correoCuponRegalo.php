<?php

if(isset($_POST['enviarP'])){
    if(!empty($_POST['optradio']) && !empty($_POST['optradio1']) && !empty($_POST['optradio2'])){
        $correo=$_SESSION['correo'];
        $asunto='Cupón de regalo';
        $msj="<h2><center>Gracias por contestar la encuesta de CutsieGirl</center></h2><h3><center>¡Obten de regalo un cupón de $100 de descuento en tu proxima compra!</center></h3>";
        $msj.='
        <center><img src="https://static.wixstatic.com/media/a27d24_fa3821ea523e4b249f49e01ed5f6ea6f~mv2.png/v1/fill/w_680,h_324,al_c,q_90,usm_0.66_1.00_0.01/a27d24_fa3821ea523e4b249f49e01ed5f6ea6f~mv2.webp"></center>'; 
        $header ="From: cutsiegirl@gmail.com" . "\r\n";
        $header.="Reply-To: cutsiegirl@gmail.com" . "\r\n";
        //$header.= "X-Mailer: PHP/" . phpversion();
        $header.= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $mail = @mail($correo,$asunto,$msj,$header);          
    }
}
?>
