<?php

include ("includes/funciones.php");
$conexion = crearConexionBD();
$dia = $_POST['valor'];

	if(isset($dia)){
	$fechas = getFechasTutorias($dia);
	}else{
	$mensajeFechas = '<option >No hay fechas disponibles</option>';
	}

cerrarConexionBD($conexion);

	for($i=0;$i<count($fechas);$i++){
	$mensajeFechas .=
	'<option value="' .$fechas[$i] .'">' .$fechas[$i] .'</option>';
		}
		
		echo $mensajeFechas;
?>