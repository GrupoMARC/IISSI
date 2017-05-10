<?php
	session_start();

	require_once("includes/funciones.php");
	
	//En el caso de la búsqueda vamos a prescindir de accion_busqueda.php y lo haremos todo en un mismo paso
	//ya que no hay datos a validar
	//Al realizar una primera búsqueda, guardamos el 'contenido' de esa búsqueda en una variable local, y luego en la sesión
	//Al realizar una segunda búsqueda, sobreescribimos 
	
	if (isset($_SESSION["buscador"])) {

		$busqueda = $_REQUEST["barra"];
		
	//	[No realizamos el unset de la variable de sesión 
	//  para no estar redirigiendo continuamente a busqueda.php, 
	//  ya que después de una primera búsqueda, las demás pueden realizarse desde aquí sin necesidad de redirigir]
	
		}
		else{
			Header("Location: busqueda.php");
		}
	
		$_SESSION["buscador"] = $busqueda;
	//Abrimos conexión con la BD, realizamos la búsqueda y cerramos
	
	$conexion=crearConexionBD();
	
	$profesoresBusq = consultarProfesores($conexion,$busqueda);

	cerrarConexionBD($conexion);
	
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Resultados de la búsqueda</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="css/general.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script type="text/javascript" src="js/funcionesJavaScript.js"></script>
		<script type="text/javascript" src="js/funcionesJQuery.js"></script>
		
		<script type="text/javascript">
	      function borrar() {
	         $('#barra').val("");
	      }
		</script>
		
	</head>
	<body>
		<!--Cabecera-->
		<?php
		include ("includes/cabecera.php");
		?>
		
		
		<!--Contenido principal-->
		<main>
			
				<article>
				<div class="contenedor">
					<section class="col-100 tablet-100 movil-100">
						<div class="formBuscar">
						<form class="buscador" id="buscador" name="buscador" method="POST" action="resultados_busqueda.php"> 
						    <input class="barra" onclick=borrar() value="<?php echo $busqueda; ?>" id="barra" name="barra" type="text" placeholder="Introduce el nombre del profesor o asignatura" autofocus >
						</form>
						</div>
					</section>
					</div>
					<div class="contenedorForm">
					<?php
					foreach($profesoresBusq as $profesor) {
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