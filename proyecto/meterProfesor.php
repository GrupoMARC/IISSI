<?php
	session_start();

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
			$formulario['dni'] = "";
			$formulario['nombre'] = "";
			$formulario['apellidos'] = "";
			$formulario['email'] = "";
			$formulario['fecha'] = "";
			$formulario['curso'] = "";
			$formulario['modalidad'] = "";
			$formulario['departamento'] = "";
			$formulario['despacho'] = "";
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION['formulario'];
			
	/* Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];*/

	include ("includes/funciones.php");
	$menuBoton_on = 1;
 ?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Prueba de web</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/general.css" />
    <link rel="stylesheet" type="text/css" href="css/matriculacion.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/funcionesJavaScript.js"></script>
	<script type="text/javascript" src="js/funcionesJQuery.js"></script>
	<script type="text/javascript" src="js/scriptsMatriculacion.js"></script>
</head>
<body>
    <!--Cabecera-->
	<?php include ("includes/cabecera.php"); ?>
    

	
	<!--Encabezado-->
    <div class="clear"></div>
    
	<!--Contenido principal-->
    <main class="contenedor">
	    <div class="col-100 tablet-col-100 movil-col-100">
	    <div class="todo" id="todo">
		<div class="dper">
			<form target="_blank" id="formulario" method="POST" action="accion_meterProfesor.php">
	    	<fieldset class="dp">
				<legend>Introducir Profesor</legend>
				<label for="nombre">Nombre:</label>
				<input id="nombre" name="nombre" type="text" required/>
				<label for="apellidos">Apellidos:</label>
				<input id="apellidos" name="apellidos" type="text" required/><br>
				<label for="dni">DNI/NIF:</label>
				<input id="dni" name="dni" type="text" required/>
				<label for="email">Correo electrónico:</label>
				<input id="email" name="email" type="text" required/><br>
				<label for="fecha">Fecha de nacimiento:</label>
				<input id="fecha" name="fecha" type="date" required/><br>
				
				<label for="departamento">Departamento:</label>
			<div >
				<select  id="departamento" name="departamento" size="1" required>
				<option value=" ">Seleccione Departamento</option> <!--valorvacio pa que salte la excecion-->
				<option value="1">Administración Empresas y C.I.M. (Mark.)</option>
				<option value="2">Anatomía y Embriología Humana</option>
				<option value="3">Arquitectura y Tecnolog. de Computadores</option>
				<option value="4">	Biología Celular</option>
				<option value="5">Bioquímica Médica y Biología Molecular</option>
				<option value="6">Cirugía</option>
				<option value="7">Electrónica y Electromagnetismo</option>
				<option value="8">Estadística e Investigación Operativa</option>
				<option value="9">Filosofía del Derecho</option>
				<option value="10">Física Aplicada I</option>
				<option value="11">Física de la Materia Condensada</option>
				<option value="12">Fisiología Médica y Biofísica</option>
				<option value="13">Genética</option>
				<option value="14">Ingeniería Aeroespacial y Mecánica de Fluidos</option>
				<option value="15">Ingeniería de Sistemas y Automática</option>
				<option value="16">Ingeniería y Ciencia de los Materiales y del Transporte</option>
				<option value="17">Lenguajes y Sistemas Informáticos</option>
				<option value="18">Matemática Aplicada I</option>
				<option value="19">Mecánica de Medios Contínuos, Teoría de Estructuras</option>
				<option value="20">Medicina Preventiva y Salud Pública</option>
				<option value="21">Organización Industrial y Gestión Empr. I</option>
				<option value="22">Organización Industrial y Gestión Empr. II</option>
				<option value="23">Tecnología Electrónica<br>
								</select>
			</div>
			<div>
				<label for="categoria">Categoría:</label>
				<select  id="categoria" name="categoria" size="1" required>
				<option value=" ">Seleccione Categoria</option> <!--valorvacio pa que salte la excecion-->
				<option value="Catedratico">Catedratico</option>
				<option value="Titular">Titular</option>
				<option value="Contratado doctor">Contratado doctor</option>
				<option value="Colaborador">Colaborador</option>
				<option value="Ayudante doctor">Ayudante doctor</option>
				<option value="Ayudante">Ayudante</option>
				<option value="Interino">Interino</option>
				</select>
			</div>	
			<div>
				<label for="despacho">Despacho:</label>
				<input id="despacho" name="despacho" type="text" required/>
			</div>
		
				<label class ="asignaturas" for="asignaturas">Asignaturas:</label>
				<br>
				<label for="curso">Curso:</label>
				<select class="curso" id="curso" name="curso" size="1" required>
					<option value="0">Seleccionar</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
				<label for="modalidad">Modalidad:</label>
				Español <input id="esp" name="modalidad" type="radio" checked required/>
				Inglés <input id="eng" name="modalidad" type="radio" required/><br>
					<div class="asigs1">
				<input name=asignaturas[] type="checkbox">Administración de Empresas<br>
				<input name=asignaturas[] type="checkbox">Álgebra Lineal y Numérica<br>
				<input name=asignaturas[] type="checkbox">Cálculo Infinitesimal y Numérico<br>
				<input name=asignaturas[] type="checkbox">Circuitos Electrónicos Digitales<br>
				<input name=asignaturas[] type="checkbox">Estadística<br>
				<input name=asignaturas[] type="checkbox">Estructura de Computadores<br>
				<input name=asignaturas[] type="checkbox">Fundamentos de Programación<br>
				<input name=asignaturas[] type="checkbox">Fundamentos Físicos de la Informática<br>
				<input name=asignaturas[] type="checkbox">Introducción a la Matemática Discreta<br>
				</div>
				<div class="asigs2">
				<input name=asignaturas[] type="checkbox">Análisis y Diseño de Datos y Algoritmos<br>
				<input name=asignaturas[] type="checkbox">Introducción a la Ingeniería del Software y los Sistemas de Información<br>
				<input name=asignaturas[] type="checkbox">Lógica Informática<br>
				<input name=asignaturas[] type="checkbox">Redes de Computadores<br>
				<input name=asignaturas[] type="checkbox">Sistemas Operativos<br>
				<input name=asignaturas[] type="checkbox">Arquitectura de Computadores<br>
				<input name=asignaturas[] type="checkbox">Arquitectura e Integración de Sistemas Software<br>
				<input name=asignaturas[] type="checkbox">Matemática Discreta<br>
				</div>
				<div class="asigs3">
				<input name=asignaturas[] type="checkbox">Diseño y Pruebas<br>
				<input name=asignaturas[] type="checkbox">Proceso Software y Gestión<br>
				<input name=asignaturas[] type="checkbox">Ingeniería de Requisitos<br>
				<input name=asignaturas[] type="checkbox">Modelado y Simulación Numérica<br>
				<input name=asignaturas[] type="checkbox">Procesamiento de Señales Multimedia<br>
				<input name=asignaturas[] type="checkbox">Arquitectura y Servicios de Redes<br>
				<input name=asignaturas[] type="checkbox">Inteligencia Artificial<br>
				<input name=asignaturas[] type="checkbox">Modelado y Visualización Gráfica<br>
				
				</div>
				<div class="asigs4">
				<input name=asignaturas[] type="checkbox">Prácticas Externas<br>
				<input name=asignaturas[] type="checkbox">Acceso Inteligente a la Información<br>
				<input name=asignaturas[] type="checkbox">Ampliación de Administración de Empresas<br>
				<input name=asignaturas[] type="checkbox">Aplicaciones de Soft Computing<br>
				<input name=asignaturas[] type="checkbox">Criptografía<br>
				<input name=asignaturas[] type="checkbox">Derecho en la Informática<br>
				<input name=asignaturas[] type="checkbox">Evolución y Gestión de la Configuración<br>
				<input name=asignaturas[] type="checkbox">Gestión de la Producción<br>
				<input name=asignaturas[] type="checkbox">Métodos Cuantitativos de Gestión<br>
				<input name=asignaturas[] type="checkbox">Planificación y Gestión de Proyectos Informáticos<br>
				<input name=asignaturas[] type="checkbox">Tecnología, Informática y Sociedad<br>
				<input name=asignaturas[] type="checkbox">Complementos de Bases de Datos<br>
				<input name=asignaturas[] type="checkbox">Estadística Computacional<br>
				<input name=asignaturas[] type="checkbox">Ingeniería del Software y Práctica Profesional<br>
				<input name=asignaturas[] type="checkbox">Integración de Sistemas Físicos e Informáticos<br>
				<input name=asignaturas[] type="checkbox">Optimización de Sistemas<br>
				<input name=asignaturas[] type="checkbox">Procesamiento de Imágenes Digitales<br>
				<input name=asignaturas[] type="checkbox">Seguridad en Sistemas Informáticos y en Internet<br>
				<input name=asignaturas[] type="checkbox">Teledetección<br>
				<input name=asignaturas[] type="checkbox">Trabajo Fin de Grado<br>
				</div>
				
				<label for="pass">Contraseña:</label>
				<input type="password" id="pass" name="pass"><br>
				<label for="passConf">Confirmar contraseña:</label>
				<input type="password" id="passConf" name="passConf"><br>
				</fieldset>
				</div> 
					<center><input class="enviarProf" type="submit" value="Confirmar"></center>
		
    </main>
    <div class="clear"></div>
    
	<!--Pie-->
	<?php include ("includes/pie.php"); ?>
</body>
</html>