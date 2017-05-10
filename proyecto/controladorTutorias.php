<?php	
	session_start();
		require_once('includes/funciones.php');
		$conexion = crearConexionBD();
		
		if (isset($_REQUEST["confirmar"])){
			$oid_t = $_REQUEST["confirmar"];
			aceptaTutoria($conexion, $oid_t);
			Header("Location: verTutorias.php");
		}else if (isset($_REQUEST["denegar"])) {
			$oid_t = $_REQUEST["denegar"];
			rechazaTutoria($conexion, $oid_t);
			Header("Location: verTutorias.php");
		}else if (isset($_REQUEST["cambiar"])) {
			$_SESSION["cambiar"]="";
			Header("Location: verTutorias.php");
		}else {
			Header("Location: excepcion.php");
		}
		cerrarConexionBD($conexion);
?>