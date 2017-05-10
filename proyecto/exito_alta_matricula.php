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
			Header("Location: matriculacion.php");
		}
	
	// ABRIR LA CONEXIÓN A LA BASE DE DATOS
		$conexion  = crearConexionBD(); 

	
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
			
			if(alta_alumno($conexion, $usuario) && alta_usuario($conexion, $usuario)){
		?>	
					<div class="contenedor">
					<span class="octavio">
					<center>¡Enhorabuena! Su proceso de matriculación se ha completado con éxito.<br>
						Ahora es un alumno de la Universidad de Sevilla.<br><br>
					<a href="login.php" class="mayte">Ir al foro</a></span></center>
					
					</div>
			<?php }else{
				header("Location: excepcion.php");
			}?>
		

	</main>
	<!--Pie-->
	<?php include ("includes/pie.php"); ?>
</body>
</html>
