<?php
session_start();
include ("includes/funciones.php");
$menuBoton_on = 1;

//Comprobamos que venimos de búsqueda
if(!isset($_REQUEST["DNI"])){
	Header("Location: busqueda.php");
}
//Guardamos los datos del profesor
$DNI_Prof = $_REQUEST["DNI"];
$nombreCompleto = $_REQUEST["nombreCompleto"];

//Obtenemos la información de tutorías de dicho profesor
$conexion = crearConexionBD();
$diasTutoria = getInfoDiasTutoriaProfesor($conexion,$DNI_Prof);
cerrarConexionBD($conexion);



 ?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>Tutorías solicitadas</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/general.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/funcionesJavaScript.js"></script>
	<script type="text/javascript" src="js/funcionesJQuery.js"></script>
	<script type="text/javascript" src="js/scriptsjQuery.js"></script>
</head>
<body>
    <!--Cabecera-->
	<?php
	include ("includes/cabecera.php");
 ?>
     <!--Menú-->
	<?php
	include ("includes/menu.php");
 ?>
 
	<?php
	if (!isset($_SESSION['DNI'])) {
		header('Location:index.php');
	} else {
		$DNI = $_SESSION['DNI'];
	}
	
  ?>
  <main>
		<div class="contenedor">
					<section class="col-100 tablet-100 movil-100">
  <div class="formPedirTutoria">
  <fieldset class="campoPedirTutoria">
  Complete el siguiente formulario para pedir tutoría a <br><b><?php echo $nombreCompleto;?></b>:<br><br>
  <form id="formulario" method="post" action="exitoPedirTutoria.php">
  	
  <input type="hidden" id="DNI" name="DNI" value="<?php echo $DNI_Prof;?>">
  
  <b>Día:</b><select id="dia" name="dia">
  	
  	   <option value="Seleccionar">Seleccionar</option>

  		<?php foreach($diasTutoria as $dia) {?>
  			<option  value="<?php echo $dia["DIA"]?>"><?php echo $dia["DIA"];?></option>
  	    <?php } ?>
  	    
  			 </select> 
  
  <b>Fecha:</b><select id="fechas" name="fecha">
  		
	    <option value="Seleccionar">Seleccionar</option>
 			  </select>
  
  <b>Hora:</b><select class="horas" id="horas" name="hora">
  	
  		<option value="Seleccionar">Seleccionar</option>
 	</select><br>
  <input class="pedirTutoria" type="submit" value="Enviar">
  </fieldset>
  </form>
  </div>
  </section>
  </div>
  </main>
  <!--Pie-->
		<?php
		include ("includes/pie.php");
		?>
 </body>
 </html>
