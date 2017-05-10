/*Funciones AJAX pedirTutoria.php
======================================================*/
$(document).ready(function(){
	
	$("#dia").change(function() {
		var diaSelec = $("#dia").val();
		var DNI = $("#DNI").val();
		$.post("obtenerFechasAJAX.php", {
			valor : diaSelec
		}, function(mensaje) {

			$("#fechas").html(mensaje);

		});
		
		$.post("obtenerHorasAJAX.php", {
			valor : diaSelec
		, dniProf:DNI}, function(mensaje) {

			$("#horas").html(mensaje);
		});

	}); 

}); 
 