/* Desplegable del menú en versión tablet y móvil
 ========================================================================== */
function desplegableMenu() {
	$("#menuCabecera").slideToggle(300);
	$("#menuCabecera").css({
		display : "inline-block"
	});
};


/* Función para desplazar el slider a la derecha
 ========================================================================== */
function moverBannerDerecha() {
	$('#slider').animate({
		marginLeft : '-' + 200 + '%'
	}, 500, function() {
		$('#slider .sliderSection:first').insertAfter('#slider .sliderSection:last');
		$('#slider').css('margin-left', '-' + 100 + '%');
	});
}

/* Función para desplazar el slider a la izquierda
 ========================================================================== */
function moverBannerIzquierda() {
	$('#slider').animate({
		marginLeft : 0
	}, 500, function() {
		$('#slider .sliderSection:last').insertBefore('#slider .sliderSection:first');
		$('#slider').css('margin-left', '-' + 100 + '%');
	});
}

/* Función para reproducir el desplazamiento del slider automáticamente
 ========================================================================== */
function reproducirBanner() {
	setInterval(function() {
		moverBannerDerecha();
	}, 5000);
}




$(document).ready(function() {
	$('#botonPosterior').on('click', function() {
		moverBannerDerecha();
	});

	$('#botonAnterior').on('click', function() {
		moverBannerIzquierda();
	});
	
	$("#desplegableMenu").on('click', function() {
		desplegableMenu();
	});
	
	reproducirBanner();
});
