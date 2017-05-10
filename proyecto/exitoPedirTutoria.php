<?php
session_start();
include ("includes/funciones.php");
$menuBoton_on = 1;
// Comprobamos que hemos llegado aquí por el formulario de matriculación
	if (isset($_REQUEST["dia"])) {
 			$dia = $_REQUEST["dia"];
			$hora = $_REQUEST["hora"];
			$dniProf = $_REQUEST["DNI"];
			$fecha = $_REQUEST["fecha"];
			}else{
 	// En caso contrario, vamos al formulario
		Header("Location: pedirTutoria.php");
		}?>
		
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Tutorías solicitadas</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/general.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/funcionesJavaScript.js"></script>
	<script type="text/javascript" src="js/funcionesJQuery.js"></script>
</head>
<body>
    <!--Cabecera-->
	<?php
	include ("includes/cabecera.php");
 ?>
     <!--Menú-->
	<?php
	include ("includes/menu.php");
 ?>
 
	<?php
	if (!isset($_SESSION['DNI'])) {
		header('Location:index.php');
	} else {
		$dniAlum = $_SESSION['DNI'];
	}
	
  ?>
  <main>
		<div class="contenedor">
					<section class="col-100 tablet-100 movil-100">
  
  <?php 
  $conexion = crearConexionBD();
  if(pedir_tutoria($conexion, $dniAlum, $dniProf, $fecha, $hora)){?>
  	<div class="exitoPedirTutoria">
  		Tutoría realizada con éxito.
  	</div>
 <?php }else{?>
	<div class="exitoPedirTutoria">
  		Error :(
  	</div>
  	<?php } ?>
  </section>
  </div>
  </main>
  <!--Pie-->
		<?php
		include ("includes/pie.php");
		?>
 </body>
 </html>
		