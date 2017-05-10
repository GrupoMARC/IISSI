<?php

include ("includes/funciones.php");
$conexion = crearConexionBD();
$dia = $_POST['valor'];
$dniProf = $_POST['dniProf'];

	if(isset($dia)){
	$horas = getHorasTutoriaDisponibles($conexion, $dniProf, $dia);
	}else{
	$mensajeHoras = '<option >No hay horas disponibles</option>';
	}

cerrarConexionBD($conexion);

	for($i=0;$i<count($horas);$i++){
	$mensajeHoras .=
	'<option value="' .date('H:i',$horas[$i]) .'">' .date('H:i',$horas[$i]) .'</option>';
		}
		
		echo $mensajeHoras;
?>