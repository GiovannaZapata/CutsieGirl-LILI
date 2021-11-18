<?php

session_start();

require 'AttachMailer.php';

date_default_timezone_set('America/Mexico_City');

include_once '../connection/Object_Connection.php';
include_once '../models/Object_Carrito.php';

$database = new Database();
$db = $database->getConnection();

$carrito = new Carrito($db);

$stmt = $carrito->getCarrito();

$nombre_cliente = strtoupper($_GET['nombre']);
$direccion = str_replace('_', '#', $_GET['direccion']);
$no_nota=$_GET['idNota'];
$modo_pago = $_GET['modo'];
$subtotal=$_GET['subtotal'];
$gastos_envio=$_GET['envio'];
$cupon=$_GET['cupon'];
$iva=$_GET['iva'];
$total_pagar="800";

define('FPDF_FONTPATH','.');
require ("fpdf/fpdf.php");


$fpdf=new FPDF('P','pt','A4');
$fpdf->AddFont('Rajdhani-Bold','','rajdhani-bold.php');
$fpdf->AddPage();
$fpdf->SetFont('Rajdhani-Bold','',14);
$fpdf->SetTextColor(64,81,69);
$fpdf->Image('../images/nota.jpg',0,0,603,850);

//Text(y, x,":v") 
$fpdf ->Text(400,220,"FECHA: ");
$fpdf ->Text(445,220,date("d/m/Y"));

$fpdf ->Text(60,220,$nombre_cliente);
$fpdf ->Text(60,250,$direccion);
$fpdf ->Text(494,250.5,$no_nota);

//Articulo
$y=390;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $fpdf ->Text(70, $y, $row['cantidad']);
    $fpdf ->Text(150, $y, $row['nombre']);
    $fpdf ->Text(250, $y, $row['precio']);
    $fpdf ->Text(492, $y, $row['cantidad']*$row['precio']);
    $y+=40;
}

$fpdf ->Text(174,633,$modo_pago);

$cupon = (-1)*($cupon/100)*$subtotal;

$total_pagar=$iva+$subtotal+$gastos_envio+$cupon;

$fpdf ->Text(492,633,'$'.$subtotal);

$fpdf ->Text(492,664,'$'.$gastos_envio);

$fpdf ->Text(492,695,'$'.$cupon);

$fpdf ->Text(492,726,'$'.$iva);

$fpdf ->Text(492,757,'$'.$total_pagar);

//nombra al archivo nota.pdf, lo guarda y lo manda el archivo al navegador
$fpdf ->OutPut('nota.pdf','F');
$fpdf ->OutPut('nota.pdf','I');


//con la clase AttachMailer.php se manda el archivo al correo del usuario
$from='cutsiegirl@gmail.com';
$to = $_SESSION['correo'];

$mailer= new AttachMailer($from, $to,"Nota de compra", "<h3>¡Gracias por comprar en CutsieGirl!</h3><p>Visualiza tu nota de compra.</p>");
$mailer->attachFile("nota.pdf");

$resultado=($mailer->send() ?"Enviado":"Problema al enviar");

echo($resultado);

?>