<?php
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
$usuario['asignaturas'] = $_REQUEST["becas"];

$acceso = array('1' => 'Estudios Postobligatorios',
				'2' => 'Ciclo Formativo de Grado Superior',
				'3' => 'Ciclo Formativo de Grado Medio',
				'4' => 'Grado',
				'5' => 'Mayores de 25 años',
				'6' => 'Mayores de 45 años',
				'7' => 'Otros');

function getFechaFormateada($fecha) {
	$fecha = date('d/m/Y', strtime($fecha));
	return $fecha;
}

function getFormaAcceso($abr) {
	global $acceso;
	if (isset($acceso[$abr])) {
		return $acceso[$abr];
	} else {
		return 'Error';
	}
}
?>

<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Ver matrícula</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/general.css" />
    <link rel="stylesheet" type="text/css" href="css/verMatricula.css" />
    <link rel="stylesheet" type="text/css" href="css/matriculacion.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/funcionesJavaScript.js"></script>
	<script type="text/javascript" src="js/funcionesJQuery.js"></script>
	<script type="text/javascript" src="js/scriptsMatriculacion.js"></script>
</head>
<body>
	<main class="contenedor">
	    <div class="col-100 tablet-col-100 movil-col-100">
	<div class="datos">
  <table class="datosPersonales">
  	<tr>
  		<td class="titulo" colspan="4">Datos personales</td>
  	</tr>
  <tr>
    <th>DNI/NIF</th>
    <td><?php echo $usuario['dni']; ?></td>
    <th>Sexo</th>
    <td><?php 
		if($usuario['sexo']=="hombre"){
			echo "Hombre";
		}else{
			echo "Mujer";
		}?></td>
  </tr>
  <tr>
    <th>Nombre</th>
    <td><?php echo $usuario['nombre']; ?></td>
    <th>Teléfono</th>
    <td><?php echo $usuario['telefono']; ?></td>
  </tr>
  <tr>
    <th>Apellidos</th>
    <td><?php echo $usuario['apellidos']; ?></td>
    <th>Código postal</th>
    <td><?php echo $usuario['cpostal']; ?></td>
  </tr>
  <tr>
    <th>Correo electrónico</th>
    <td><?php echo $usuario['email']; ?></td>
    <th>Provincia</th>
    <td><?php echo $usuario['provincia']; ?></td>
  </tr>
   <tr>
     <th>Fecha de nacimiento</th>
    <td><?php echo $usuario['fecha']; ?></td>
    <th>Dirección</th>
    <td><?php echo $usuario['direccion']; ?></td>
  </tr>
 
</table>
</div>

<div class="datos">
  <table class="datosPersonales">
  	<tr>
  		<td class="titulo" colspan="4">Datos académicos</td>
  	</tr>
  <tr>
    <th>Curso</th>
    <td><?php echo $usuario['curso']; ?></td>
    <th>Forma de acceso</th>
    <td><?php echo getFormaAcceso($usuario['acceso']);?></td>
  </tr>
  <tr>
    <th>Modalidad</th>
    <td><?php 
			if($usuario['modalidad']=="esp"){
			echo "Español";
		}else{
			echo "Inglés";
		}?></td>
    <th>Becas y subvenciones</th>
    <td><?php echo $usuario['becas']; ?></td>
  </tr>
 </table>
</div>
	</div>
	</main>

</body>
</html>