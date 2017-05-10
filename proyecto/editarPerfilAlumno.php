<?php
session_start();
require_once ("includes/funciones.php");
$menuBoton_on = 1;
$conexion = crearConexionBD();
if (isset($_SESSION["dato"])) {
	$dato = $_SESSION["dato"];
	unset($_SESSION["dato"]);
}
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>Editar perfil alumno</title>
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
		<div class="clear"></div>
		<?php
		if (isset($_SESSION["DNI"])) {
			$DNI = $_SESSION["DNI"];
			//	unset($_SESSION["DNI"]);
			$datos = getInfoAlumno($conexion, $DNI);
			$grupo = getGrupoAlumno($conexion, $DNI);
			$grado = getGradoAlumno($conexion, $DNI);
			$curso = getCursoAlumno($conexion, $DNI);
			$codAsignaturas = getCodigoAsignaturas($conexion, $DNI);
		}
		?>
		<!--Contenido principal-->
		<main>
			<article class="datosAlumno">
				<!--<form method="post" action="controladorEditarAlumno.php">-->
					<div class="datosAlumno">
						<!--<p><input name="DNI" type="hidden" value="<?php echo $DNI; ?>"/></p>		
						<p><input name="nombre" type="hidden" value="<?php echo $datos["NOMBRE"]; ?>"/></p>
						<p><input name="apellidos" type="hidden" value="<?php echo $datos["APELLIDOS"]; ?>"/></p>
						<p><input name="fechaNacimiento" type="hidden" value="<?php echo $datos["FECHA_NACIMIENTO"]; ?>"/></p>
						<p><input name="email" type="hidden" value="<?php echo $datos["EMAIL"]; ?>"/></p>
						<p><input name="grupo" type="hidden" value="<?php echo $grupo['OID_GRUP']; ?>"/></p>
						<p><input name="grado" type="hidden" value="<?php echo $grado['OID_G']; ?>"/></p>
						<p><input name="curso" type="hidden" value="<?php echo $curso['CURSO']; ?>"/></p>
						-->
						<table>
						<p> <?php echo $DNI; ?> </p>
						<p>Nombre: <?php echo $datos["NOMBRE"]; ?></p>
						<p>Apellidos: <?php echo $datos["APELLIDOS"]; ?></p>
						<p>Fecha de Nacimiento: <?php echo $datos["FECHA_NACIMIENTO"]; ?></p>
						<p>Email: <?php echo $datos["EMAIL"]; ?></p>
						<p>Grupo: <?php $nombreGrupo = getNombreGrupo($conexion, $grupo['OID_GRUP']);
										echo $nombreGrupo['NOMBRE']; ?></p>	
						<p>Grado: <?php $nombreGrado = getNombreGrado($conexion, $grado['OID_G']); 
											echo $nombreGrado['NOMBRE']; ?></p>	
						<p>Curso: <?php echo  $curso['CURSO']; ?></p>
						
						<h1><b>Asignaturas</b></h1>
						<ul>
						<?php forEach($codAsignaturas as $codigo_asig){?>
							<li><?php

							$asignatura = getAsignaturaAlumno($conexion, $codigo_asig['CODIGO_ASIG']);
							echo $asignatura['NOMBRE'];
								?>
							</li>
						<?php } ?>
						</ul>
						</table>
					</div>
				
			</article>
			
		</main>

		<div class="clear"></div>

		<!--Pie-->
		<?php
		cerrarConexionBD($conexion);
		include ("includes/pie.php");
		?>
	</body>
</html>