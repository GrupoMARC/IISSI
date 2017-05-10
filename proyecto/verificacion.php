<?php
session_start();
include_once("includes/funciones.php");

$usuario["usuario"] = $_REQUEST["DNI"];
$usuario["contrasenia"] = $_REQUEST["pass"];

$conexion = crearConexionBD();

$info = getInfoUsuario($conexion, $usuario["usuario"]);
$errores = validacion($usuario);

cerrarConexionBD($conexion);

if (count($errores)>0) {
	
	$_SESSION["errores"] = $errores;
	header("Location:login.php");
	
} else {
	unset($_SESSION["errores"]);
	$_SESSION["DNI"]=$usuario["usuario"];
	header("Location:index.php");
}

function validacion($usuario) {
	$errores = array();
	global $info;
	
		if(empty($usuario["usuario"])) {
			$errores[] = "El usuario está vacío.";
			unset($_SESSION["user"]);

		}elseif(empty($info["DNI"])){
			$errores[] = "El usuario no se encuentra registrado.";
		}else{
			$_SESSION["user"] = $usuario["usuario"];
		}
		if(empty($usuario["contrasenia"])) {
			
			$errores[] = "La contraseña esta vacía.";
			
		}elseif($usuario["contrasenia"]!=$info["PASS"]){
			
			$errores[]="La contraseña es incorrecta.";
		} 
	return $errores;
}
?>