<?php
session_start();
include ("includes/funciones.php");
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
<?php
if (isset($_SESSION["paginacion"])) {
	$paginacion = $_SESSION["paginacion"];
}
$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

if ($pagina_seleccionada < 1) {
	$pagina_seleccionada = 1;
}
if ($pag_tam < 1) {
	$pag_tam = 5;
}
unset($_SESSION["paginacion"]);

$conexion = crearConexionBD();
$query = "SELECT OID_T, Fecha, Hora_Comienzo, Duracion, Estado, DNI_Prof FROM Tutorias WHERE (DNI_Alum = '$DNI') ORDER BY Fecha ";

$total_registros = total_consulta($conexion, $query);
$total_paginas = (int)($total_registros / $pag_tam);
if ($total_registros % $pag_tam > 0)
	$total_paginas++;
if ($pagina_seleccionada > $total_paginas)
	$pagina_seleccionada = $total_paginas;

$paginacion["PAG_NUM"] = $pagina_seleccionada;
$paginacion["PAG_TAM"] = $pag_tam;
$_SESSION["paginacion"] = $paginacion;

$tutorias = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
?>

	<!--Banner-->
    <div id="banner">      
         
	</div>
	<div class="clear"></div>
	
	<!--Encabezado-->
    <section>
    
    </section>
    <div class="clear"></div>
    
	<!--Contenido principal-->
   	<main class="noPadding">
    	 <nav>
		<div>
			<?php
				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ ) 
					if ( $pagina == $pagina_seleccionada) { 	?>
						<span class="current"><?php echo $pagina; ?></span>
			<?php }	else { ?>			
						<a href="verTutorias.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>			
		</div>
		
		<form method="get" action="verTutorias.php">
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
			Mostrando 
			<input id="PAG_TAM" name="PAG_TAM" type="number" 
				min="1" max="<?php echo $total_registros; ?>" 
				value="<?php echo $pag_tam?>" autofocus="autofocus" /> 
			entradas de <?php echo $total_registros?>
			<input type="submit" value="Cambiar">
		</form>
	</nav>
	
	<div class="tutorias">
    	<h1>Tutorías</h1>
    	
    			
    	<table>
    		<tr>
				<th>Fecha</th> <th>Hora de comienzo</th> <th>Duración</th> <th>Profesor</th> <th>Estado</th>
			</tr>
    	<?php foreach($tutorias as $tutoria){?>
    		<tr class="libro">
				<td> <?php echo $tutoria['FECHA'] ?></td>
				<td> <?php echo $tutoria['HORA_COMIENZO'] ?></td>
				<td> <?php echo $tutoria['DURACION'] ?></td>
				<td> <?php  $nombre = nombreProfesor($tutoria['DNI_PROF'], $conexion);
					echo $nombre['NOMBRE'] ." ".$nombre['APELLIDOS'] ;
					cerrarConexionBD($conexion);
				?></td>
				<td> <?php echo $tutoria['ESTADO'] ?></td>
				
			</tr>
    	<?php } ?>
    	
    	</table>
   
    	</div>
    	
    </main>
    <div class="clear"></div>
    
	<!--Pie-->
	<?php
	include ("includes/pie.php");
 ?>
</body>
</html>