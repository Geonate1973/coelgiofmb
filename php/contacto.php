<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLANTILLA PARA CONTACTO Y reCAPTCHA</title>
    <link rel="stylesheet" type="text/css" href="css/formulario.css">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    
<?php
//aqui lo primero que declara es que la variable enviado es falsa y los demas estan vacios
$enviado = false;
$Vnombre = NULL;
$Vcelular = NULL;
$Vemail = NULL;
$Vdni = NULL;
$Vmensaje = NULL;

// esta es una condicional, SI ya fue ejecutado Fenviado, entonces debera hacer....
if(isset($_POST["Fenviado"])){
    $enviado = true; //si se ejecuto Fenviado, entonces enviado se convertira en tru (cambio, al inicio estaba false)
    $Vnombre = $_POST["Fnombre"];
    $Vcelular = $_POST["Fcelular"];
    $Vemail = $_POST["Femail"];
    $Vdni = $_POST["Fdni"];
    $Vmensaje = $_POST["Fmensaje"];
}

?>



<form action="" method = "POST">
    <!-- DATOS DE FORMULARIO -->
<h2>CONTACTANOS CON NOSOTROS</h2>
<label for="nombre">Nombre Completo:</label>
<!-- el php que esta dentro del value hace que grabe el nombre y se cree una variable (igual en las demas), esto permite que lo escrito se quede en memoria y no se borre-->
<input type="text" name="Fnombre"  value="<?php echo $Vnombre; ?>">  
<label for="nombre">Número de Celular:</label>
<input type="number" name="Fcelular"   value="<?php echo $Vcelular; ?>"> 
<label for="nombre">Email:</label>
<input type="email" name="Femail"   value="<?php echo $Vemail; ?>"> 
<label for="nombre">DNI:</label>
<input type="number" name="Fdni"   value="<?php echo $Vdni; ?>">
<label for="nombre">Cuál es tu consulta?</label>
<textarea name="Fmensaje" id="" cols="30" rows="10" value=""><?php echo $Vmensaje; ?></textarea>
<div class="g-recaptcha" data-sitekey="6LfLIbcUAAAAAInX8S4G78b35rmsdq-FxnkCK9N-"></div>
<input type="submit" value="Enviar"  name="Fenviado">

</form>

<?php

if($enviado){
    if($Vnombre == NULL){
        echo "Por favor escribe tu Nombre <br>";
    }

    if ($Vcelular == NULL){
        echo "Por favor escribe tu Celular <br>";
    }

    if ($Vemail == NULL){
        echo "Por favor escribe tu Email <br>";
    }

    if ($Vdni == NULL){
        echo "Por favor escribe tu DNI <br>";
    }

    if($Vmensaje == NULL){
        echo "Por favor escribe tu mensaje <br>";
    }
}
// aqui vamos a revisar si todo esta ingresado entonces...
if ($Vnombre!=NULL && $Vcelular!=NULL && $Vemail!=NULL && $Vdni!=NULL && $Vmensaje!=NULL){

    $recaptcha = $_POST["g-recaptcha-response"];

$url = "https://www.google.com/recaptcha/api/siteverify";
$data = array(
	"secret" => "6LfLIbcUAAAAAC873kFGGTqyiNPxNJN1No7kvIJB", 
	"response" => $recaptcha
);
$options = array(
	"http" => array (
		"method" => "POST",
		"content" => http_build_query($data)
	)
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success = json_decode($verify);
if ($captcha_success->success) {

    //datos de correo

	$cabeceras  = "MIME-Version: 1.0\r\n"; 
	$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
	$cabeceras .= "From: Mensaje reCAPTCHA esto es una cabecera <geonate@gmail.com>\r\n";

	$titulo = "Mensaje desde la Web de paginde prueba, esto es un titulo";
	//$correo= "desarrollo@geodreamspro.com, carlossilva@carmontiperu.com";
	$correo= "desarrollo@geodreamspro.com";

	$asunto="Envio desde formulario web de la pagina de PRUEBA reCATPCHA, esto es el asunto";

	$mensaje="Nombre:" . $Vnombre . "<br>";
	$mensaje.="Email: " . $Vemail . "<br>";
	$mensaje.="Celular: " .$Vcelular."<br>";
	$mensaje.="DNI: " .$Vdni."<br>";
	$mensaje.="Mensaje: " .$Vmensaje."<br>";
	
		mail($correo,$titulo, $mensaje, $cabeceras );
		header("Location: http://carmontiperu.com/gracias.html"); 
    
}else echo " <font color = 'red'> <b>DEBES DARLE CLICK AL reCAPTCHA</b> </font>";} //para colocar atributos el echo, solo debemos incluirlo dentro de las comillas los datos html

?>




</body>
</html>
