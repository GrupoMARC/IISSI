
 $(document).ready(function(){
 	
 	
	contador = 0;
	
	$(".siguiente").click(function() {
		if(contador<5){
		contador++;
		}
		if(validaForm1()==false){
			contador--
		}
		if(contador==1 && validaForm1()){
			$('.dper').css("display","none");
			$('.dac').fadeIn("slow");
	
		}
		if(contador==2){
			if(validaForm2()==false){
				contador--;
			}else{
				$(".dac").css("display","none");
				$(".conf").fadeIn("slow");
		
			}
		}
	})
	
	$(".atras").click(function(){
			contador--;
			if($('.dac').is(":visible")){
			$('.dac').css("display","none");
			$('.dper').fadeIn("slow");
			}else if($('.conf').is(":visible")){
			$('.conf').css("display","none");
			$('.dac').fadeIn("slow");
			}
			})
			
	$(".enviar").click(function(){
		$('.tick3').css("visibility","visible");
		$(".exito").fadeIn();
        $(".exito").fadeIn("slow");
        $(".exito").fadeIn(3000);
	});


	function despIzq(){
		$('.todo').animate({
				scrollLeft: "+=1000"}, 650);
		$('.arrow').animate({width:'60%'},300);
		$('.arrow').animate({width:'80%'},300);
	}
	
	 	$('.arrow2').click(function(){
	 		if(contador>0){
	 		contador--;
	 		}
			$('.todo').animate({
				scrollLeft: "-=1000"}, 650);
			$('.arrow2').animate({width:'60%'},500);
			$('.arrow2').animate({width:'80%'},500);
	});
	
	res = $('.dac').css("top");
	$('#curso').change(function(){
		original = $('.dac').height();
		$(".asignaturas").fadeIn();
        $(".asignaturas").fadeIn("slow");
        $(".asignaturas").fadeIn(3000);
		if($('#curso').val()==0){
			$(".asignaturas").fadeOut();
        $(".asignaturas").fadeOut("slow");
        $(".asignaturas").fadeOut(3000);
			$('.asigs1').slideUp("slow");
			$('.asigs2').slideUp("slow");
			$('.asigs3').slideUp("slow");
			$('.asigs4').slideUp("slow");
			$(".dac").animate({"top": res}, "slow");
		}
		if($('#curso').val()==1){
			$('.asigs1').slideDown("slow");
			$('.asigs2').slideUp("slow");
			$('.asigs3').slideUp("slow");
			$('.asigs4').slideUp("slow");
		}
		if($('#curso').val()==2){
			$('.asigs1').slideUp("slow");
			$('.asigs2').slideDown("slow");
			$('.asigs3').slideUp("slow");
			$('.asigs4').slideUp("slow");
		}
		if($('#curso').val()==3){
			$('.asigs1').slideUp("slow");
			$('.asigs2').slideUp("slow");
			$('.asigs3').slideDown("slow");
			$('.asigs4').slideUp("slow");
		}
		if($('#curso').val()==4){
			$('.asigs1').slideUp("slow");
			$('.asigs2').slideUp("slow");
			$('.asigs3').slideUp("slow");
			$('.asigs4').slideDown("slow");
		}
		
	});

function validaForm1(){
	    if($("#nombre").val() == ""){
        alert("Introduzca su nombre.");
        $("#nombre").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#apellidos").val() == ""){
        alert("Introduzca sus apellidos.");
        $("#apellidos").focus();
        return false;
    }
    if($("#telefono").val() == ""){
        alert("Introduzca su número de teléfono.");
        $("#telefono").focus();
        return false;
    }
     if(!/[0-9]/.test($("#telefono").val())){
        alert("Introduzca un número de teléfono correcto");
        $("#telefono").focus();
        return false;
    }
    
    if($("#dni").val() == ""){
        alert("Introduzca su DNI");
        $("#dni").focus();
        return false;
    }
    if(!($("#dni").val().length == 9) || (!/[0-9]{8}[A-Z]/.test($("#dni").val()))){
        alert("Introduzca un DNI válido");
        $("#dni").focus();
        return false;
    }
   
    if($("#email").val() == ""){
        alert("Introduzca su email.");
        $("#email").focus();
        return false;
    }
    
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!expr.test($("#email").val())){
        alert("Introduzca un email correcto.");
        $("#email").focus();
        return false;
    }
    if($("#direccion").val() == ""){
        alert("Introduzca su dirección");
        $("#direccion").focus();
        return false;
    }
    if($("#cpostal").val() == ""){
        alert("Introduzca su código postal");
        $("#cpostal").focus();
        return false;
    }
    if(!($("#cpostal").val().length == 5) || (!/[0-9]/.test($("#cpostal").val()))){
        alert("Introduzca un código postal válido");
        $("#cpostal").focus();
        return false;
    }
    return true;
}
	
function validaForm2(){
    if($("#curso").val() == "0"){
        alert("Seleccione su curso.");
        $("#curso").focus(); 
        return false;
    }
    if($("#acceso").val() == "0"){
        alert("Seleccione su forma de acceso al grado.");
        $("#acceso").focus(); 
        return false;
    }
    if($("#asignaturas").val() == ""){
        alert("Seleccione las asignaturas en las que desea matricularse.");
        $("#asignaturas").focus(); 
        return false;
    }
    if($("#fecha").val() == "dd/mm/aaaa"){
        alert("Seleccione su fecha de nacimiento.");
        $("#fecha").focus(); 
        return false;
    }
    
    
    return true; 
}

	
})
