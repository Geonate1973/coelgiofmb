<?php
$nombre=$_POST['nombre'];
$email=$_POST['email'];
$telf=$_POST['telf'];
$asunto=$_POST['asunto'];
$mensaje=$_POST['mensaje'];
$cabeceras = 'From: Formulario Web Colegio Frances Mary Buss' . "\r\n" .
    'Reply-To: info@colegiofrancesmarybuss.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$mensaje = "
Este mensaje fue enviado por " . $nombre . " 
su Email es " . $email . " y telefono es " .$telf. "
El Asunto es el siguiente:" . $asunto. "
Su mensaje es el siguiente:  ". $mensaje . " 
Enviado el " . date('d/m/Y', time());
;
mail("info@colegiofrancesmarybuss.com","Mensaje desde Pagina Web del Colegio", $mensaje, $cabeceras );

header('Location: http://www.colegiofrancesmarybuss.com/gracias.html'); 
?>