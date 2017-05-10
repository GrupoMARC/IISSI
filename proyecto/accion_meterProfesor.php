<?php
    session_start();
		// Comprobamos que hemos llegado aquí por el formulario de matriculación
	if (isset($_SESSION["formulario"])) {
 			$usuario['DNI'] = $_REQUEST["dni"];
			$usuario['nombre'] = $_REQUEST["nombre"];
			$usuario['apellidos'] = $_REQUEST["apellidos"];
			$usuario['email'] = $_REQUEST["email"];
			$usuario['fecha'] = $_REQUEST["fecha"];
			$usuario['categoria'] = $_REQUEST["categoria"];
			$usuario['oid_dep'] = $_REQUEST["departamento"];
			$usuario['oid_d'] = $_REQUEST["despacho"];
			$usuario['PASS'] = $_REQUEST["pass"];
			}
			else{
 	// En caso contrario, vamos al formulario
		Header("Location: meterProfesor.php");}
	// Guardar la variable local con los datos del formulario en la sesión.			
		$_SESSION["formulario"] = $usuario;
	// Validamos el formulario en servidor 
	$errores = validarDatosUsuario($usuario);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: meterProfesor.php');
	} else{
		Header('Location: exito_meterProfesor.php');
	}
	
// 	Funcion de validación 
	function validarDatosUsuario($usuario){
			
		// Validación del DNI
		
		if($usuario["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $usuario["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $usuario["dni"]. "</p>";
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

		// 	Validación de la fecha

		if($usuario["fecha"]==""){
			$errores[] = "<p>La fecha de nacimiento no puede estar vacía</p>";
		}else if($usuario["fecha"] >= date("Y-m-d")){
			$errores[] = "<p>La fecha de nacimiento es incorrecta</p>";
		}else if(strtotime($usuario["fecha"])-strtotime(date("Y-m-d"))<18){
			$errores[] = "<p>Debes ser mayor de 18 años</p>";
		}
		
		// Validación del despacho 
		
		if($usuario["despacho"]=="") {
			$errores[] = "<p>El despacho no puede estar vacío</p>";
		}
		
		// Validación del departamento
		
		if($usuario["departamento"]=="") {
			$errores[] = "<p>El despacho no puede estar vacío</p>";
		}

		// Validación del curso
		
		if($usuario["curso"]=="") {
			$errores[] = "<p>El curso no puede estar vacío</p>";
		}
	
		
	}
?>