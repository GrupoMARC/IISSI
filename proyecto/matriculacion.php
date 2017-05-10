<?php
	session_start();

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['formulario'])) {
			$formulario['dni'] = "";
			$formulario['sexo'] = "";
			$formulario['nombre'] = "";
			$formulario['apellidos'] = "";
			$formulario['email'] = "";
			$formulario['telefono'] = "";
			$formulario['fecha'] = "";
			$formulario['provincia'] = "";
			$formulario['direccion'] = "";
			$formulario['cpostal'] = "";
			$formulario['curso'] = "";
			$formulario['acceso'] = "";
			$formulario['modalidad'] = "";
			$formulario['becas'] = "";
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$formulario = $_SESSION['formulario'];
			
	/* Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)*/
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];

	include ("includes/funciones.php");
	$menuBoton_on = 1;
 ?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Proceso de matriculación</title>
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
	<?php include ("includes/cabecera.php"); 
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
	?>
    

	
	<!--Encabezado-->
    <div class="clear"></div>
    
	<!--Contenido principal-->
    <main class="contenedor">
	    <div class="col-100 tablet-col-100 movil-col-100">
	    <div class="todo" id="todo">
		<div class="dper">
			<form target="_blank" id="formulario" method="POST">
	    	<fieldset class="dp">
				<legend>Datos personales</legend>
				<label for="nombre">Nombre:</label>
				<input id="nombre" name="nombre" type="text" required/>
				<label for="sexo">Sexo:</label>
				Mujer <input id="mujer" name="sexo" type="radio" checked/>
				Hombre <input id="hombre" name="sexo" type="radio" /><br>
				<label for="apellidos">Apellidos:</label>
				<input id="apellidos" name="apellidos" type="text" required/><br>
				<label for="telefono">Teléfono:</label>
				<input id="telefono" name="telefono" type="text" required/>
				<label for="dni">DNI/NIF:</label>
				<input id="dni" name="dni" type="text" required/><br>
				<label for="email">Correo electrónico:</label>
				<input id="email" name="email" type="text" required/><br>
				<label for="fecha">Fecha de nacimiento:</label>
				<input id="fecha" name="fecha" type=<?php if(strpos($user_agent, 'Firefox') !== FALSE){
					echo "text";
				}else{
					echo "date";
				} ?> required/><br>
				<label for="direccion">Dirección:</label>
				<input id="direccion" name="direccion" type="text" required/><br>
				<label for="provincia">Provincia:</label>
				<input list="opcionesProvincias" name="provincia" id="provincia"/>
				<datalist id="opcionesProvincias">
			  	<option label='Almería' value='Almería'>
			  	<option label='Cádiz' value='Cádiz'>
			  	<option label='Córdoba' value='Córdoba'>
			  	<option label='Granada' value='Granada'>
			  	<option label='Huelva' value='Huelva'>
			  	<option label='Jaén' value='Jaén'>
			  	<option label='Málaga' value='Málaga'>
			  	<option label='Sevilla' value='Sevilla'>
				</datalist>
				<label for="cpostal">Código postal:</label>
				<input id="cpostal" name="cpostal" type="text" required/>
				</fieldset>
				</div>
				
			<div class="dac">
			<fieldset id="dacd">
				<legend>Datos académicos</legend>
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
				<label class ="asignaturas" for="asignaturas">Asignaturas:</label>
				<br>
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
				
				<label for="acceso">Forma de acceso:</label>
				<select class="acceso" id="acceso" name="acceso" size="1" required>
					<option value="0">Seleccionar</option>
					<option value="1">Estudios Postobligatorios</option>
					<option value="2">Ciclo Formativo de Grado Medio</option>
					<option value="3">Ciclo Formativo de Grado Superior</option>
					<option value="4">Grado</option>
					<option value="5">Mayores de 25 años</option>
					<option value="6">Mayores de 45 años</option>
					<option value="7">Otros</option>
				</select><br>
				<label for="becas">Becas y subvenciones:</label>
				<br>
				<input name="becas" value="No soy becario" type="radio" checked><b>No soy becario</b>
				<input name="becas" value="Becario MEC" type="radio">Becario MEC
				<input name="becas" value="Deportista alto riesgo" type="radio">Deportista alto riesgo
				<input name="becas" value="Discapacitados" type="radio">Discapacitados
				<br>

			</fieldset>
				</div>
				<div class="conf">
			<fieldset>
				<legend>Confirmación</legend>
				Está a punto de terminar el proceso de matriculación en la Universidad de Sevilla. Al matricularse, podrá
				acceder a la plataforma de tutorías de la universidad. Para ello debe escoger una contraseña, Su nombre de usuario
				vendrá dado por su número de DNI.
				Para ver su matrícula, pulse el botón "Ver matrícula". Si desea modificar algún campo, pulse volver atrás.
				Si todos los datos son correctos y ya ha introducido su contraseña, por favor proceda a confirmar la matrícula.<br>
				
				<label for="pass">Contraseña:</label>
				<input type="password" id="pass" name="pass"><br>
				<label for="passConf">Confirmar contraseña:</label>
				<input type="password" id="passConf" name="passConf"><br>
				<center><input class="ver" type="submit" value="Ver matrícula" onclick=this.form.action="verMatricula.php">
				<input class="enviar" type="submit" value="Confirmar" onclick=this.form.action="accion_alta_matricula.php"></center>
			</fieldset>
		</div>
		</div>
		</div>
		<input type="button" class="siguiente" value="Siguiente">
		<input type="button" class="atras" value="Atrás">
    </main>
    <div class="clear"></div>
    
	<!--Pie-->
	<?php include ("includes/pie.php"); ?>
</body>
</html>