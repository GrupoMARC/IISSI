<?php
	session_start();
	include ("includes/funciones.php");
	$menuBoton_on = 0;
	
	$excepcion = $_SESSION["excepcion"];
	unset($_SESSION["excepcion"]);
	
	if (isset($_SESSION["destino"])) {
		$destino = $_SESSION["destino"];
		unset($_SESSION["destino"]);
	} else {
		$destino = "";
	}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>¡Se ha producido un problema!</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/general.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/funcionesJavaScript.js"></script>
	<script type="text/javascript" src="js/funcionesJQuery.js"></script>
</head>
<body>
	<!--Cabecera-->
	<?php include ("includes/cabecera.php"); ?>
	<!--Menú-->
	<?php include ("includes/menu.php"); ?>
	
	<section class="contenedor">
		<div class="col-100 tablet-col-100 movil-col-100">
			<h1>Ups!</h1>
		</div>
	</section>
	<div class="clear"></div>
	
	<!--Contenido principal-->
    <main class="contenedor">
    	<div class="col-100 tablet-col-100 movil-col-100">
    		<?php if ($destino != "") { ?>
			<p>
				Ocurrió un problema durante el procesado de los datos. Pulse <a href="<?php echo $destino ?>">aquí</a> para volver a la página principal.
			</p>
			<?php } 
				else { ?>
			<p>
				Ocurrió un problema para acceder a la base de datos.
			</p>
			<?php } ?>
    	</div>
    	<div class="col-100 tablet-col-100 movil-col-100">
			<?php echo "Información relativa al problema: $excepcion" ?>
		</div>
    </main>
    <div class="clear"></div>
    
	<!--Pie-->
	<?php include ("includes/pie.php"); ?>
</body>
</html>