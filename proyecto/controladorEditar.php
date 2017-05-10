<?php
session_start();
include_once ("includes/funciones.php");
if (isset($_REQUEST["DNI"])) {

	$conexion = crearConexionBD();
	$dato["DNI"] = $_REQUEST["DNI"];
	$dato["nombre"] = $_REQUEST["nombre"];
	$dato["apellidos"] = $_REQUEST["apellidos"];
	$dato["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
	$dato["email"] = $_REQUEST["email"];
	$dato["categoria"] = $_REQUEST["categoria"];
	$dato["despacho"] = $_REQUEST["despacho"];
	$dato["departamento"] = $_REQUEST["departamento"];
	$dato["hora_inicio"] = $_REQUEST["hora_Inicio"];
	$dato["hora_fin"] = $_REQUEST["hora_Fin"];
	$dato["dia"] = $_REQUEST["dia"];

	$_SESSION["dato"] = $dato;
	$DNI = $dato["DNI"];

	if (isset($_REQUEST["editarDespacho"])) {

		$_SESSION["modificarDespacho"] = $dato["despacho"];
		if ($errores != "") {
			Header("Location: excepcion.php");
		} else {
			Header("Location: editarPerfilProfesor.php");
		}
	} elseif (isset($_REQUEST["grabarDespacho"])) {
		$oid_d = getOIDDespacho($conexion, $_REQUEST["modificarDespacho"]);//ok
		if($oid_d['OID_D']==NULL){
			$_SESSION["excepcion"]="El despacho no existe.";
			Header("Location: excepcion.php");
		}
		modificarDespacho($conexion, $DNI, $oid_d['OID_D']);
		Header("Location: editarPerfilProfesor.php");

	} elseif (isset($_REQUEST["cancelarDespacho"])) {

		unset($_SESSION["modificarDespacho"]);
		header("Location:editarPerfilProfesor.php");

	} elseif (isset($_REQUEST["editarDepartamento"])) {

		$_SESSION["modificarDepartamento"] = $dato["departamento"];
		if ($errores != "") {
			Header("Location: excepcion.php");
		} else {
			Header("Location: editarPerfilProfesor.php");
		}
	} elseif (isset($_REQUEST["grabarDepartamento"])) {

		$errores = modificarDepartamento($conexion, $DNI, $_REQUEST["modificarDepartamento"]);
		if ($errores != "") {
			Header("Location: excepcion.php");
		} else {
			Header("Location: editarPerfilProfesor.php");
		}

	} elseif (isset($_REQUEST["cancelarDepartamento"])) {

		unset($_SESSION["modificarDepartamento"]);
		Header("Location:editarPerfilProfesor.php");

	} elseif (isset($_REQUEST["editarCategoria"])) {

		$_SESSION["modificarCategoria"] = $dato["categoria"];
		Header("Location: editarPerfilProfesor.php");

	} elseif (isset($_REQUEST["cancelarCategoria"])) {

		unset($_SESSION["modificarCategoria"]);
		header("Location:editarPerfilProfesor.php");

	} elseif (isset($_REQUEST["grabarCategoria"])) {
		$errores = modificarCategoria($conexion, $DNI, $_REQUEST["categoria"]);
		if ($errores != "") {
			$_SESSION["excepcion"]=$errores;
			Header("Location: excepcion.php");
		} else {
			Header("Location: editarPerfilProfesor.php");
		}
	} elseif (isset($_REQUEST["editarHorario"])) {

		$_SESSION["modificarHorario"] = $dato["hora_inicio"];
		Header("Location: editarPerfilProfesor.php");

	} elseif (isset($_REQUEST["grabarHorario"])) {
		$errores = modificarHorario($conexion, $DNI, $_REQUEST["modificarHorarioInicioTutorias"], $_REQUEST["modificarHorarioFinTutorias"]);
		
			Header("Location: editarPerfilProfesor.php");
		
	} elseif (isset($_REQUEST["cancelarHorario"])) {

		unset($_SESSION["modificarHorario"]);
		header("Location:editarPerfilProfesor.php");

	} elseif (isset($_REQUEST["editarDia"])) {

		$_SESSION["modificarDia"] = $dato["dia"];
		Header("Location: editarPerfilProfesor.php");

	} elseif (isset($_REQUEST["grabarDia"])) {
		$errores = modificarDiaTutoria($conexion, $DNI, $_REQUEST["modificarDia"]);
		Header("Location: editarPerfilProfesor.php");
	} elseif (isset($_REQUEST["cancelarDia"])) {

		unset($_SESSION["modificarDia"]);
		header("Location:editarPerfilProfesor.php");

	}
	cerrarConexionBD($conexion);
} else
	Header("Location: editarPerfilProfesor.php");
?>
