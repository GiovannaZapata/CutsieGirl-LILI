<?
include_once '../connection/Object_Connection.php';
include_once '../models/mail/mail.php';

$database = new Database();
$db = $database->getConnection();

$paciente = new Paciente($db);
$enigma = new Enigma();

$idPaciente = $_POST['idPaciente'];
$email = $_POST['correo'];
$idReceta = $_POST['idReceta'];
$paciente->altaCorreo($idPaciente, $email);
$stmtPaciente = $paciente->buscarPaciente($_POST['idPaciente']);
$rowPaciente = $stmtPaciente->fetch(PDO::FETCH_ASSOC);

$idEncriptado = $enigma->encrypt($idReceta);
$pass = $enigma->pass();
$passEncriptado =  $enigma->encrypt($pass);
$prueba = $enigma->decrypt($idEncriptado); 

$url = 'mgh='.$idEncriptado.'&mgl='.$passEncriptado;
$msg1 = "Estimado(a): ".strtoupper($rowPaciente['Nombre'])." <br><br>Para ver y decargar su receta del dia ".date('Y/m/d')." seleccione el siguiente enlace:<br><br><a href='www.fertilcenter.com.mx/recetas/index.php?".$url."'>VER MI RECETA</a> <br><br> En la pantalla de acceso a su receta, ingrese la siguiente clave de acceso: <br><br><b>CLAVE DE ACCESO: ".$pass."";
        $mail = new Correo();
        $mail->to = $email;
        $mail->subject = json_decode('"\uD83D\uDCE7"')."  Fertilcenter Receta ".date('Y/m/d')."  ".json_decode('"\uD83D\uDCDD"')."";
        $mail->body = $msg1;
        $mail->from = "farmacia@fertilcenter.com.mx";
        echo $result = $mail->enviar();

?>
