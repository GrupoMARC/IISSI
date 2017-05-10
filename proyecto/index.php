<?php
session_start();
include_once ("includes/funciones.php");
if (!isset($_SESSION["DNI"])) {
	header("Location:login.php");
}
$menuBoton_on = 1;
$conexion = crearConexionBD();
$dni=$_SESSION["DNI"];
$admin = esAdministrador($conexion, $dni);

if($admin["ESADMINISTRADOR"] == 1){
	header("Location:vistaAdmin.php");
}
cerrarConexionBD($conexion);

?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Prueba de web</title>
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
			include_once ("includes/menu.php");
		?>

		<!--Slider-->
		<div class="contenedorSlider">
			<div id="slider">
				<?php crearSlider(); ?>
			</div>
			<span id="botonAnterior" class="botonAnterior"> < </span>
			<span id="botonPosterior" class="botonPosterior"> > </span>
		</div>
		<div class="clear"></div>

		<!--Contenido principal-->
		<main>
			<article>
				<div class="contenedor">
					<section class="col-100 tablet-100 movil-100">
						<h1 class="alinearCentro">¿Qué es M.A.R.C?</h1>
					</section>
					<div class="col-50 tablet-col-100 movil-col-100">
						<p>
							M.A.R.C es una aplicación dinámica creada con el objetivo de facilitar la gestión de tutorías a los usuarios de la Universidad. Gracias a M.A.R.C, alumnos y profesores dispondrán de una amplia variedad de funciones mediante las cuales podrán concertar tutorías de forma rápida y sencilla.
						</p>
						<p>
							Los alumnos podrán visualizar fácilmente el horario de tutorías de todos los profesores de la Universidad, pudiendo consultar su disponibilidad y escogiendo el momento que mejor les convenga.
						</p>
					</div>
					<div class="col-50 tablet-col-100 movil-col-100">
						<p>
							También tendrán la posibilidad de cancelar las citas concertadas o de modificarlas. Los profesores, por su parte, podrán aceptar o denegar las peticiones recibidas, así como modificar su horario de tutorías para mantenerlo siempre actualizado.
						</p>
					</div>
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