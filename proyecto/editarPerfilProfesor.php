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
		include ("includes/menu.php");
		?>
		<div class="clear"></div>
		<?php
		if (isset($_SESSION["DNI"])) {
			$DNI = $_SESSION["DNI"];
		//	unset($_SESSION["DNI"]);
			$datos = getInfoProfesor($conexion, $DNI);
			$infoTutorias = getInfoDiasTutoriaProfesor($conexion, $DNI);
			$despacho = nombreDespacho($conexion, $datos["OID_D"]);
			$departamento = nombreDepartamento($conexion, $datos["OID_DEP"]);
		}
		?>
		<!--Contenido principal-->
		<main>
			<article class="datosProfesor">
				<form method="post" action="controladorEditar.php">
					<div class="datosProfesor">
						<p><input name="DNI" type="hidden" value="<?php echo $DNI; ?>"/></p>		
						<p><input name="nombre" type="hidden" value="<?php echo $datos["NOMBRE"]; ?>"/></p>
						<p><input name="apellidos" type="hidden" value="<?php echo $datos["APELLIDOS"]; ?>"/></p>
						<p><input name="fechaNacimiento" type="hidden" value="<?php echo $datos["FECHA_NACIMIENTO"]; ?>"/></p>
						<p><input name="email" type="hidden" value="<?php echo $datos["EMAIL"]; ?>"/></p>
						<p><input name="categoria" type="hidden" value="<?php echo $datos["CATEGORIA"]; ?>"/></p>
						<p><input name="despacho" type="hidden" value="<?php echo $datos["OID_D"]; ?>"/></p>
						<p><input name="departamento" type="hidden" value="<?php echo $datos["OID_Dep"]; ?>"/></p>
						<p><input name="hora_Inicio" type="hidden" value="<?php echo $infoTutoria["Hora_Comienzo_Tutoria"]; ?>"/></p>
						<p><input name="hora_Fin" type="hidden" value="<?php echo $infoTutoria["Hora_Fin_Tutoria"]; ?>"/></p>
						<p><input name="dia" type="hidden" value="<?php echo  $infoTutoria["Dia"]; ?>"/></p>
						
					
						<p>Nombre: <?php echo $datos["NOMBRE"]; ?></p>
						<p>Apellidos: <?php echo $datos["APELLIDOS"]; ?></p>
						<p>Fecha de Nacimiento: <?php echo $datos["FECHA_NACIMIENTO"]; ?></p>
						<p>Email: <?php echo $datos["EMAIL"]; ?></p>
					<?php
						if ( isset($dato) && isset($_SESSION["modificarDespacho"])) { //OK FALTA LO DEMAS.
							
							?>
							
							<p>Despacho: <input name="modificarDespacho" type="text" value="<?php echo $despacho["NOMBRE"]; ?>"/></p>
							
						<?php }	else { ?>
							<p>Despacho: <?php echo $despacho["NOMBRE"]; ?></p>	
										
					<?php } ?>
					</div>
					
					<div class="botones">
					<?php if (isset($dato)&& isset($_SESSION["modificarDespacho"])) { 
						unset($_SESSION["modificarDespacho"]);?>
							
							<button name="grabarDespacho" type="submit" class="grabarDatoDespacho">
							<img src="img/guardar.png" class="grabar" alt="Grabar dato despacho">
							</button>
							<button name="cancelarDespacho" type="submit" class="cancelarDespacho">
							<img src="img/cancelar.png" class="cancelar" alt="Cancelar">
							</button>
						
					<?php } else { ?> 
							<button name="editarDespacho" type="submit" class="editarDatoDespacho">
							<img src="img/editar.png" class="editar" alt="Editar Dato" >
							</button>
					<?php } ?>
					</div>
					<?php
						if ( isset($dato) && isset($_SESSION["modificarDepartamento"])) { 
							?>
							
							<!--<p>Departamento: <input name="modificarDepartamento" type="text" value="<?php echo $departamento["NOMBRE"]; ?>"/></p>-->
							<select  id="departamento" name="departamento" size="1" required>
									<option value="AECIM">Administración Empresas y C.I.M. (Mark.)</option>
									<option value="AEH">Anatomía y Embriología Humana</option>
									<option value="ATC">Arquitectura y Tecnolog. de Computadores</option>
									<option value="BC">	Biología Celular</option>
									<option value="BMBM">Bioquímica Médica y Biología Molecular</option>
									<option value="CIR">Cirugía</option>
									<option value="EE">Electrónica y Electromagnetismo</option>
									<option value="EIO">Estadística e Investigación Operativa</option>
									<option value="FD">Filosofía del Derecho</option>
									<option value="FA1">Física Aplicada I</option>
									<option value="FMC">Física de la Materia Condensada</option>
									<option value=">FMB">Fisiología Médica y Biofísica</option>
									<option value="G">Genética</option>
									<option value="IAMF">Ingeniería Aeroespacial y Mecánica de Fluidos</option>
									<option value="ISA">Ingeniería de Sistemas y Automática</option>
									<option value="ICMT">Ingeniería y Ciencia de los Materiales y del Transporte</option>
									<option value="LSI">Lenguajes y Sistemas Informáticos</option>
									<option value="MA1">Matemática Aplicada I</option>
									<option value="MMCTE">Mecánica de Medios Contínuos, Teoría de Estructuras</option>
									<option value="MPSP">Medicina Preventiva y Salud Pública</option>
									<option value="OIGE1">Organización Industrial y Gestión Empr. I</option>
									<option value="OIGE2">Organización Industrial y Gestión Empr. II</option>
									<option value="DTE">Tecnología Electrónica<br>
								</select>
						<?php }	else { ?>
							<p>Departamento: <?php echo $departamento["NOMBRE"]; ?></p>
					<?php } ?>
					</div>
					
					<div class="botones">
					<?php if (isset($dato)&& isset($_SESSION["modificarDepartamento"])) { 
						unset($_SESSION["modificarDepartamento"]);?>
							<button name="grabarDepartamento" type="submit" class="grabarDatoDepartamento">
							<img src="img/guardar.png" class="grabar" alt="Grabar dato departamento">
							</button>
							<button name="cancelarDepartamento" type="submit" class="cancelarDepartamento">
							<img src="img/cancelar.png" class="cancelar" alt="Cancelar">
							</button>
					<?php } else { ?> 
							<button name="editarDepartamento" type="submit" class="editarDatoDepartamento">
							<img src="img/editar.png" class="editar" alt="Editar dato departamento">
							</button>
					<?php } ?>
					</div>
					<div>
					<?php
						if ( isset($dato) && isset($_SESSION["modificarCategoria"])) { 
							
							?>
							
							<!--<p>Categoría: <input name="modificarCategoria" type="text" value="<?php echo $datos["Categoria"]; ?>"/></p>-->
							<label for="categoria">Categoría:
								<select  id="categoria" name="categoria" size="1" required>
									<option value="Catedrático">Catedrático</option>
									<option value="Titular">Titular</option>
									<option value="Contratado doctor">Contratado doctor</option>
									<option value="Colaborador">Colaborador</option>
									<option value="Ayudante doctor">Ayudante doctor</option>
									<option value="Ayudante">Ayudante</option>
									<option value="Interino">Interino</option>
								</select>
							</label>
						<?php }	else { ?>
							<p>Categoría: <?php echo $datos["CATEGORIA"]; ?></p>					
					<?php } 
				?>
					</div>
					
					<div class="botones">
					<?php if (isset($dato) && isset($_SESSION["modificarCategoria"])) {
							unset($_SESSION["modificarCategoria"]); ?>
							<button name="grabarCategoria" type="submit" class="grabarDatoCategoria">
							<img src="img/guardar.png" class="grabar" alt="Grabar Dato">
							</button>
							<button name="cancelarCategoria" type="submit" class="cancelarCategoria">
							<img src="img/cancelar.png" class="cancelar" alt="Cancelar">
							</button>
					<?php } else { ?> 
							<button name="editarCategoria" type="submit" class="editarDato">
							<img src="img/editar.png" class="editar" alt="Editar dato categoria">
							</button>
					<?php } ?>
					</div>
					<h1><b>Información de tutorías</b></h1>
					<!-- Hacer un for each -->
					<?php foreach ($infoTutorias as $infoTutoria) {?>
					<div>
						<p>---------------------------------------------------------------------</p>
						<?php
						if ( isset($dato) && isset($_SESSION["modificarHorario"])) { 
							
							?>
							
							<p>Hora inicio tutoria: <input name="modificarHorarioInicioTutorias" type="text" value="<?php echo $infoTutoria["HORA_COMIENZO_TUTORIA"]; ?>"/></p>
							<p>Hora fin tutoria: <input name="modificarHorarioFinTutorias" type="text" value="<?php echo $infoTutoria["HORA_FIN_TUTORIA"]; ?>"/></p>
							
						<?php }	else { ?>
							<p>Horario inicio tutoria: <?php echo $infoTutoria["HORA_COMIENZO_TUTORIA"]; ?></p>
							<p>Horario fin tutoria: <?php echo $infoTutoria["HORA_FIN_TUTORIA"]; ?></p>	
							
												
					<?php } 
					?>
					</div>
					
					<div class="botones">
					<?php if (isset($dato)&& isset($_SESSION["modificarHorario"])) { 
						unset($_SESSION["modificarHorario"]);?>
							<button name="grabarHorario" type="submit" class="grabarDatoHorario">
							<img src="img/guardar.png" class="grabar" alt="Grabar dato horario">
							</button>
							<button name="cancelarHorario" type="submit" class="cancelarDia">
							<img src="img/cancelar.png" class="cancelar" alt="Cancelar">
							</button>
					<?php } else { ?> 
							<button name="editarHorario" type="submit" class="editarDatoHorario">
							<img src="img/editar.png" class="editar" alt="Editar dato horario">
							</button>
					<?php } ?>
					</div>
					<div>
						<?php
						if ( isset($dato) && isset($_SESSION["modificarDia"])) { 
							
							?>
							
							<label for="dia">Dia:
								<select  id="modificarDia" name="modificarDia" size="1" required>
									<option value="Lunes">Lunes</option>
									<option value="Martes">Martes</option>
									<option value="Miércoles">Miércoles</option>
									<option value="Jueves">Jueves</option>
									<option value="Viernes">Viernes</option>
									
								</select>
							</label>
							
						<?php }	else { ?>
							<p>Dia: <?php echo $infoTutoria["DIA"]; ?></p>
					<?php } ?>
					</div>
					
					<div class="botones">
					<?php if (isset($dato) && isset($_SESSION["modificarDia"])) { 
						unset($_SESSION["modificarDia"]);
						?>
							<button name="grabarDia" type="submit" class="grabarDatoDia">
							<img src="img/guardar.png" class="grabar" alt="Grabar dato horario">
							</button>
							<button name="cancelarDia" type="submit" class="cancelarDia">
							<img src="img/cancelar.png" class="cancelar" alt="Cancelar">
							</button>
					<?php } else { ?> 
							<button name="editarDia" type="submit" class="editarDatoDia">
							<img src="img/editar.png" class="editar" alt="Editar dato dia">
							</button>
					<?php } ?>
					</div>
					<?php } ?>
				</form>
			</article>
			<p>----------------------------------------------------------------------------------------------------</p>
			
		</main>

		<div class="clear"></div>

		<!--Pie-->
		<?php
		cerrarConexionBD($conexion);
		include ("includes/pie.php");
		?>
	</body>
</html>