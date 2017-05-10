<?php
	
	include ("includes/funciones.php");
	session_start();
	$menuBoton_on = 1;
	
	

	// Si no existen datos de búsqueda en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['buscador'])) {
			$busqueda = "";
	
		$_SESSION['buscador'] = $busqueda;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$busqueda = $_SESSION['buscador'];

	$conexion = crearConexionBD();
	
	$profesores = mostrarProfesores($conexion);

	cerrarConexionBD($conexion);
	
	
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Búsqueda de profesores</title>
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


		<!--Contenido principal-->
		<main>
			<article>
				<div class="contenedor">
					<section class="col-100 tablet-100 movil-100">
						<div class="formBuscar">
						<form class="buscador" id="buscador" name="buscador" method="POST" action="resultados_busqueda.php"> 
						    <input class="barra" id="barra" name="barra" type="text" placeholder="Introduce el nombre del profesor o asignatura" autofocus >
						</form>
						</div>
					</section>
					</div>
					<div class="contenedorForm">
					<?php
					foreach($profesores as $profesor) {
					?>
						<form method="post" action="pedirTutoria.php" id="formBusqueda">
						<input type="hidden" name="DNI" value="<?php echo $profesor["DNI"]?>">
						<input type="submit" name="nombreCompleto" value="<?php echo $profesor["NOMBRE"] ." " .$profesor["APELLIDOS"];?>">
						</form>
					<?php }?>
					</div>
				
			</article>
			<div class="clear"></div>
		</main>

		<div class="clear"></div>

		<!--Pie-->
		<?php
		include ("includes/pie.php");
		?>
	</body>
</html>