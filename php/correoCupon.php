<?php

if(isset($_POST['suscribirme'])){
    if(!empty($_POST['email1'])){
        $email1=$_POST['email1'];
        $asunto='Cupón por suscripcion';
        $msj="<h3><center>¡Felicidades obtuviste un cupón del 40%OFF</center></h3>";
        $msj.='
        <center><img src="https://static.wixstatic.com/media/a27d24_62762df53f7e465a82fc976dac9d91c0~mv2.png/v1/fill/w_680,h_324,al_c,q_90,usm_0.66_1.00_0.01/a27d24_62762df53f7e465a82fc976dac9d91c0~mv2.webp"></center>'; 
        $header ="From: cutsiegirl@gmail.com" . "\r\n";
        $header.="Reply-To: cutsiegirl@gmail.com" . "\r\n";
        //$header.= "X-Mailer: PHP/" . phpversion();
        $header.= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $mail = @mail($email1,$asunto,$msj,$header);  
        if($mail){
            echo"<script>
                swal({
                    icon: 'success',
                    title: 'FELICIDADES',
                    text: 'Cupón enviado exitosamente!',
                    buttons: false,
                    timer: 4000
                })
            </script>";
        }else{
            echo"<script>
                swal({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Error en  el envio de su cupón!',
                    buttons: false,
                    timer: 4000
                })
            </script>";
        }
    }
}

?>
