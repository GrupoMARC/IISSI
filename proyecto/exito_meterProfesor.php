<?php
	session_start();

	
	require_once("includes/funciones.php");
		
	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL FORMULARIO YA VALIDADOS
	if (isset($_SESSION["formulario"])) {
	// RECOGER LOS DATOS Y ANULAR LOS DATOS DE SESIÓN (FORMULARIO Y ERRORES)
		$usuario = $_SESSION["formulario"];
		unset($_SESSION["formulario"]);
		}
	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
		else{
			Header("Location: meterProfesor.php");
		}
	
	// ABRIR LA CONEXIÓN A LA BASE DE DATOS
		$conexion  = crearConexionBD(); 
		alta_profesor($conexion,$usuario);
		cerrarConexionBD($conexion);

	
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Alta de alumno realizada con éxito</title>
  <link rel="stylesheet" type="text/css" href="css/matriculacion.css" />
  <link rel="stylesheet" type="text/css" href="css/general.css" />
</head>

<body>

	
		 <!--Cabecera-->
		<?php include ("includes/cabecera.php"); 
			$profesor="Profesor";
			if(alta_usuario($conexion,$usuario,$profesor) && alta_profesor($conexion,$usuario) ){
		?>	
				<div class="contenedor">
					<div class="col-50 tablet-col-100 movil-col-100">
					<div class="exito">
					¡Enhorabuena! El proceso de introduccion de profesor 
					 se ha realizado correctamente.
				
					</div>
				</div>
			<?php }else{
				echo "El profesor ya existe.";
			}?>
		

	</main>
	<!--Pie-->
	<?php include ("includes/pie.php"); ?>
</body>
</html>
