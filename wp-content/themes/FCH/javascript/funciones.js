$(function(){
	//ASIGNACIÓN DE LOS TOOLTIPS
// 	$('[title]').each(function(){
// 		$(this).attr('data-tooltip', $(this).attr('title'));
// 		$(this).removeAttr('title')
// 	});
// 	
	$('#searchform').submit(function(e){
		if($(this).find('input').val().length < 3)
			e.preventDefault();
	});
	
	var retardoAparicion = 150;
	for(i = 0; i < $('.resultado-busqueda').size(); i ++)
	{
		$('.resultado-busqueda:eq(' + i + ')').addClass('inicio-aparicion').delay(retardoAparicion * i).animate({'top' : '0', 'opacity':'1'}, 800, function(){
			$(this).css('opacity' , '1');
			$(this).css('top', '');
			$(this).removeClass('inicio-aparicion');
			$(this).addClass('final-aparicion');
		});
	}
	
	$('.academico > p:first-of-type').each(function(){
		var contenido = $(this).html();
		var padre = $(this).parent();
		$(this).remove();
		padre.prepend(contenido);
	});
	
	var anchoFotoPerfil = $('.academico > a').width();
	$('.academico > a, .academico > a img').css({'width' : '126px', 'height' : '126px'});
	
	$('.link-mosaico-rojo a[title], .link-mosaico-azul a[title], .link-mosaico-amarillo a[title], .link-mosaico-gris a[title], .link-mosaico-gris-oscuro a[title], .link-mosaico-verde a[title], .link-mosaico-teal a[title]').each(function(){
		$(this).append('<span>' + $(this).attr('title') + '</span>')
		$(this).removeAttr('title')
	});
	
	$('[data-tooltip]').mousemove(function(e){
		$("#tooltip").html($(this).attr('data-tooltip'));
		posicionY = e.clientY - ($("#tooltip").outerHeight(true) + 15);
		$("#tooltip").css({"top" : posicionY + "px", "left" : (e.clientX - $("#tooltip").outerWidth(true) / 2 + 5) + "px"}).show();
	});
	
	$("[data-tooltip]").mouseout(function(){
		$("#tooltip").hide();
	});
	
	$('[data-boton-busqueda]').click(function(){
		$(this).parent().toggleClass('busqueda-activa');
		$(this).parent().find('input[type=text]').focus();
	});
	
	$(window).scroll(function(){
		//console.log($(window).scrollTop());
		if($(window).scrollTop() >= 295)
		{
			$('#cabecera-single, #contenidos-single').addClass('fijar-cabecera');
		}
		else
			$('#cabecera-single, #contenidos-single').removeClass('fijar-cabecera');
	});
	
	//EVENTOS BÁSICOS DE REVISÓN DE FORMULARIOS
	$('form').submit(function(){
		campos = $(this).find('[data-requerido]');
		campos.removeClass('campo-faltante');
		if(campos.length > 0)
		{
			erroneos = 0;
			for(i = 0; i < campos.length; i ++)
				if(campos.eq(i).val() == "")
				{
					campos.eq(i).addClass('campo-faltante');
					erroneos ++;
				}
			if(erroneos > 0)
				return false;
			else if($(this).attr('id') == 'formulario-login')
			{
				$.post($(this).attr('action'), $(this).serialize(), function(datos){
					if(datos == 'exito')
						document.location = './lanzar';
					else
						alert('Los datos son incorrectos o tu cuenta se encuentra deshabilitada. Intenta nuevamente.');
				});
				return false;
			}
		}
	});
	
	//EVENTOS TÁCTILES PARA GALERÍAS
	var totalImagenes = $('.galeria > img').size();
	$('.galeria').hide();
	var tamanoImagen = $('.galeria > img').width();
	$('.galeria').show();
	var posicionFinal = (100 - tamanoImagen) / 2;
	var imagenActual = 1;
	var duracion = 500;
	var puntoInicial = puntoFinal = 0;
	var animando = false;
	var longitudGesto = 80;
	
	$(window).resize(recalcularGaleria);
	
	function recalcularGaleria()
	{
		$('.galeria').hide();
		tamanoImagen = $('.galeria > img').width();
		$('.galeria').show();
		posicionFinal = (100 - tamanoImagen) / 2;
		$('.galeria > img').removeAttr('style');
		imagenActual = 1;
	}
	
	function cambiarFoto(direccion)
	{
		if(totalImagenes > 1) {
			var imagenSiguiente;
			var desplazamiento;
			if(!animando)
			{
				animando = true;
				switch(direccion)
				{
					case 'derecha':
						if(imagenActual > 1)
							imagenSiguiente = imagenActual - 1;
						else
							imagenSiguiente = totalImagenes;
						desplazamiento = tamanoImagen + '%';
					break;

					case 'izquierda':
						if(imagenActual < totalImagenes)
							imagenSiguiente = imagenActual + 1;
						else
							imagenSiguiente = 1;
						desplazamiento = '-' + tamanoImagen  + '%';
					break;
				}
				$('.galeria > img').eq(imagenSiguiente - 1).css({'z-index' : '1', 'display' : 'block'});
				$('.galeria > img').eq(imagenActual - 1).css('z-index', '2')
														.animate({'left' : desplazamiento}, duracion, function(){
															$(this).css({'z-index' : '0', 'left' : posicionFinal + '%', 'display' : 'none'})
																   .removeClass('actual');
															$('.galeria > img').eq(imagenSiguiente - 1)
																			   .css({'z-index' : '0', 'left' : posicionFinal + '%'})
																			   .addClass('actual');
															imagenActual = imagenSiguiente;
															animando = false;
														});
			}
		}
	}
	
	function moverCanvas(direccion, longitud) {
		if(direccion == 'abajo') {
			$("html, body").stop().animate({
				scrollTop: $('.galeria').offset().top - longitud
			}, 700);
		}
		else if(direccion == 'arriba') {
			$("html, body").stop().animate({
				scrollTop: (($('.galeria').offset().top) + $('.galeria').height())
			}, 700);
		}
	}
	
	inicioGesto = function(e){
		e.preventDefault();
		if(e.touches && e.touches.length > 1){
			return;
		}
		puntoInicial = calcularPosicion(e.originalEvent);
		if(window.pointerEventsSupport)
		{
			$(document).on(pointerMoveName, moverGesto);
			$(document).on(pointerUpName, terminarGesto);
		}
		else
		{
			$(document).on('touchmove', moverGesto);
			$(document).on('touchend', terminarGesto);
			$(document).on('touchcancel', terminarGesto);
			$(document).on('mousemove', moverGesto);
			$(document).on('mouseup', terminarGesto);
		}
	}.bind(this);
	
	terminarGesto = function(e){
		e.preventDefault();
		if(e.touches && e.touches.length > 0){
			return;
		}
		if(window.pointerEventsSupport)
		{
			$(document).unbind(pointerMoveName, moverGesto);
			$(document).unbind(pointerUpName, terminarGesto);
		}
		else
		{
			$(document).unbind('touchmove', moverGesto);
			$(document).unbind('touchend', terminarGesto);
			$(document).unbind('touchcancel', terminarGesto);
			$(document).unbind('mousemove', moverGesto);
			$(document).unbind('mouseup', terminarGesto);
		}
		var diferencia = puntoInicial.x - puntoFinal.x;
		var diferenciaY = puntoInicial.y - puntoFinal.y;
		var longitud = Math.abs(diferencia);
		var longitudY = Math.abs(diferenciaY);
		var direccion = '';
		if(diferencia < 0)
			direccion = 'derecha';
		else
			direccion = 'izquierda';
		if(longitud > longitudGesto) {
			cambiarFoto(direccion);
			console.log(direccion);
		}
		else {
			if(diferenciaY < 0)
				direccion = 'abajo';
			else
				direccion = 'arriba'
			if(longitudY > longitudGesto)
				moverCanvas(direccion, longitudY);
			console.log(direccion);
		}
	}.bind(this);
	
	moverGesto = function(e) {
		puntoFinal = calcularPosicion(e.originalEvent);
	}.bind(this);
	
	function calcularPosicion(e)
	{
		var punto = {};
		if(e.targetTouches)
		{
			punto.x = e.targetTouches[0].clientX;
			punto.y = e.targetTouches[0].clientY;
		}
		else
		{
			punto.x = e.clientX;
			punto.y = e.clientY;
		}
		return punto;
	}
	
	if(window.pointerEventsSupport)
	{
		$('.galeria').on(pointerDownName, inicioGesto);
	}
	else
	{
		$('.galeria').on('touchstart', inicioGesto);
		$('.galeria').on('mousedown', inicioGesto);
	}
});