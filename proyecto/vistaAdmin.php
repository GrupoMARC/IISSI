
<?php
session_start();
include_once ("includes/funciones.php");
if (!isset($_SESSION["DNI"])) {
    header("Location:login.php");
}
$menuBoton_on = 1;
 
?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Prueba de web</title>
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
         
        <!--Menú de adminisitrador-->
        <?php
            include_once ("includes/menu.php");
        ?>
 
       <!---Contenido vista administrador-->
 
 
 			<p>Se encuentra en la vista de Administrador, puede acceder a las funciones de administrador a traves del menu de la cabecera</p>
 
 
 
        <!--Pie-->
        <?php
        include ("includes/pie.php");
        ?>
    </body>
</html></html>