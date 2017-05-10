<?php
    session_start();
		// Comprobamos que hemos llegado aquí por el formulario de matriculación
	if (isset($_SESSION["formulario"])) {
 			$usuario['dni'] = $_REQUEST["dni"];
			$usuario['sexo'] = $_REQUEST["sexo"];
			$usuario['nombre'] = $_REQUEST["nombre"];
			$usuario['apellidos'] = $_REQUEST["apellidos"];
			$usuario['email'] = $_REQUEST["email"];
			$usuario['telefono'] = $_REQUEST["telefono"];
			$usuario['fecha'] = $_REQUEST["fecha"];
			$usuario['provincia'] = $_REQUEST["provincia"];
			$usuario['direccion'] = $_REQUEST["direccion"];
			$usuario['cpostal'] = $_REQUEST["cpostal"];
			$usuario['curso'] = $_REQUEST["curso"];
			$usuario['acceso'] = $_REQUEST["acceso"];
			$usuario['modalidad'] = $_REQUEST["modalidad"];
			$usuario['becas'] = $_REQUEST["becas"];
			$usuario['pass'] = $_REQUEST["pass"];
			$usuario['passConf'] = $_REQUEST["passConf"];
			}
			else{
 	// En caso contrario, vamos al formulario
		Header("Location: matriculacion.php");}
	// Guardar la variable local con los datos del formulario en la sesión.			
		$_SESSION["formulario"] = $usuario;
	// Validamos el formulario en servidor 
	$errores = validarDatosUsuario($usuario);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: excepcion.php');
	} else{
		Header('Location: exito_alta_matricula.php');
	}
	
	//----------------Validación del usuario----------------

	function validarDatosUsuario($usuario){
			
		// Validación del DNI
		
		if($usuario["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $usuario["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $usuario["dni"]. "</p>";
		}
		
		// Validación del sexo
		
		if($suario["sexo"] != "Mujer" && $usuario["sexo"] != "Hombre") {
			
			$errores[] = "<p>El sexo debe ser Hombre o Mujer</p>";
		}
		
		// Validación del nombre
		
		if($usuario["nombre"]=="" || ctype_alpha($usuario["nombre"])) {
			$errores[] = "<p>El nombre no puede estar vacío o no ser alfabetico</p>";
		}
		
		// Validación de los apellidos
		
		if($usuario["apellidos"]=="" || ctype_alpha($usuario["apellidos"])) {
			$errores[] = "<p>Los apellidos no puede estar vacío o no ser alfabeticos</p>";
		}
		
		// Validación del email
		
		if($usuario["email"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(filter_var($usuario["email"], FILTER_VALIDATE_EMAIL)==false){
			$errores[] = $error . "<p>El email es incorrecto: " . $usuario["email"]. "</p>";
		}
		
		// Validación del teléfono	
			
		if($usuario["telefono"]=="" or !is_numeric($usuario["telefono"]) or strlen($usuario["telefono"])<9) {
			$errores[] = "<p>El teléfono no es correcto</p>";
		}
		
		// Validación de la fecha
		
		if($usuario["fecha"]==""){
			$errores[] = "<p>La fecha de nacimiento no puede estar vacía</p>";
		}else if($usuario["fecha"] >= date("Y-m-d")){
			$errores[] = "<p>La fecha de nacimiento es incorrecta</p>";
		}else if(strtotime($usuario["fecha"])-strtotime(date("Y-m-d"))<18){
			$errores[] = "<p>Debes ser mayor de 18 años</p>";
		}
		
		// Validacion provincia
		
		if($usuario["provincia"] != "Almería" && $usuario["provincia"] != "Cádiz" && $usuario["provincia"] != "Córdoba" && $usuario["provincia"] != "Granada" 
		&& $usuario["provincia"] != "Huelva" && $usuario["provincia"] != "Jaén" && $usuario["provincia"] != "Sevilla"&& $usuario["provincia"] != "Málaga" 
			|| $usuario["provincia"]=="") {
			
			$errores[] = "<p>Provincia erronea</p>";
		}
			
		// Validación de la contraseña
		
		if(!isset($usuario["pass"]) || strlen($usuario["pass"])<8){
			$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		}else if(!preg_match("/[a-z]+/", $usuario["pass"]) || 
			!preg_match("/[A-Z]+/", $usuario["pass"]) || !preg_match("/[0-9]+/", $usuario["pass"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		}else if($usuario["pass"] != $usuario["passConf"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
		
		// Validación del código postal
		
		if($usuario["cpostal"]==""or !is_numeric($usuario["cpostal"]) || strlen($usuario["cpostal"])!=5  ) {
			$errores[] = "<p>El cpostal no es válido.</p>";
		}
		
		// Validación del curso
		
		if($usuario["curso"]=="") {
			$errores[] = "<p>El curso no puede estar vacío</p>";
		}
		
		// Validación forma de acceso
		
		if($usuario["acceso"]=="") {
			$errores[] = "<p>La forma de acceso no puede estar vacío</p>";
		}
	}
?>