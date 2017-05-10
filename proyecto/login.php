<?php
session_start();
include_once ("includes/funciones.php");
$_SESSION["DNI"] = "";

$errores = null;
if (isset($_SESSION["errores"])) {

	$errores = $_SESSION["errores"];
}
if (!empty($_SESSION["user"])) {
	$usuario = $_SESSION["user"];
}
if (!empty($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
}
$menuBoton_on = 1;
?>

<!DOCTYPE html>

<html lang="en">
	<head>

		<meta charset="utf-8" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>index</title>
		<meta name="description" content="" />
		<meta name="author" content="Manue" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<?php if(isset($errores) and empty($usuario)){
		?>
		<link rel="stylesheet" type="text/css" href="css/falloUsuario.css" />
		<?php }if((isset($errores) and !empty($usuario)) or count($errores)>1){ ?>
		<link rel="stylesheet" type="text/css" href="css/falloPass.css" />
		<?php } ?>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/general.css" />
	</head>

	<body>
		<script>
			function recuadroFeoUser() {
				$("#user").css("background", "white");
			}

			function recuadroFeoPass() {
				$("#pass").css("background", "white");
			}

			function cambiaImg() {
				$("#enviar").attr("src", "img/varios/entrarActivo.png");
			}

			function imgOriginal() {
				$("#enviar").attr("src", "img/varios/entrar.png");
			}
		</script>

		<?php
		if (isset($errores) and count($errores) > 0) {
			if (count($errores) > 1) {
				echo '<script>alert("Atención:\n' . $errores[0] . '\n' . $errores[1] . '");</script>';

			} else if (count($errores) < 2) {
				echo '<script>alert("Atención:\n' . $errores[0] . '");</script>';
			}
			unset($_SESSION["errores"]);
		}
		?>

		<script>
			function isMayus(input) {
				kCode = input.keyCode ? input.keyCode : input.which;
				sKey = input.shiftKey ? input.shiftKey : ((kCode == 16) ? true : false);
				if (((kCode >= 65 && kCode <= 90) && !sKey) || ((kCode >= 97 && kCode <= 122) && sKey )) {
					$('.mayus').css("visibility", "visible");

				} else {
					$('.mayus').css("visibility", "hidden");
				}
			}

		</script>
		<script>
			("body", "html").onkeypress = "isMayus(event)";
			$(document).ready(function() {
				keydown = "isMayus(event)";
			})
		</script>
		<!--Cabecera-->
		<?php
		include ("includes/cabecera.php");
		?>
		
		<!--Menú-->
		<?php
			include_once ("includes/menu.php");
		?>

		<div class="recuadro">

			<center>
				<legend>
					Inicio sesión
				</legend>
			</center>
			<center>
				<form id="formulario" action="verificacion.php" method="post">
					<fieldset class="inicio alinearCentro">
						<p>
							Usuario</br>
							<input onfocus="recuadroFeoUser()" id="DNI" name="DNI" type="text" value=<?php
							if (!empty($usuario))
								echo $usuario;
							?>>
						</p>
						<br />
						<p>
							Contraseña</br>
							<input id="pass" onfocus="recuadroFeoPass()" name="pass" onkeypress="isMayus(event)" type="password" />
						</p>
						<div class="mayus" style="display:none">
							<p>
								El block mayus está activado
							</p>
						</div>
						<br/>
					
					<input id="enviar" name="enviar" type="image" onmouseout="imgOriginal()" onmouseover="cambiaImg()" src="img/varios/entrar.png" width="50" height="50"/>
					</fieldset>
				</form>
			</center>
		</div>
		<?php
			include_once ("includes/pie.php");
			unset($_SESSION["DNI"]);
		?>
	</body>
</html>
