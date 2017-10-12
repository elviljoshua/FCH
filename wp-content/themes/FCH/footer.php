<?php
/**
 * Despliega el pie de la página
 *
 * Contiene el cierre de elementos estructurales iniciados en el header
 *
 * @package WordPress
 * @subpackage Catarsis
 * @since Catarsis 1.0
 */
?>
	</div> <!-- Finalización de contenedor principal -->
	<footer>
		<div id="menu-pie" class="container_12">
			<div class="grid_12">
				<div class="grid_4 alpha">
					<?php echo mostrar_menu('la-facultad', 'La Facultad'); ?>
				</div>
				<div class="grid_4">
					<?php 
						echo mostrar_menu('oferta-educativa', 'Oferta Educativa');
						echo mostrar_menu('vinculacion', 'Vinculación'); 
					?>
				</div>
				<div class="grid_4 omega">
					<?php echo mostrar_menu('estudiantes', 'Estudiantes'); ?>
				</div>
			</div>
		</div>
		<div id="contenedor-blanco">
			Facultad de Ciencias Humanas Universidad Autónoma de Baja California
		</div>
		<div id="contenedor-amarillo">
			<div class="container_12">
				<div class="grid_4 push_2">
					<h6>Facultad de Ciencias Humanas</h6>
					<span>Bulevar Castellón y Lombardo Toledano s/n</span>
					<span>Conjunto Urbano Esperanza 21350</span>
					<span>Mexicali Baja California México.</span>
					<a href="https://www.facebook.com/cienciashumanasuabc1418" id="logo-facebook" target="_blank">/cienciashumanasuabc1418</a>
					<a href="https://www.google.com.mx/maps/place/Universidad+Autónoma+de+Baja+Californa+Facultad+de+Ciencias+Humanas/@32.612493,-115.471812,17z/data=!4m6!1m3!3m2!1s0x80d7709fbfec3f63:0xa21a83286b3b40c4!2sUniversidad+Autónoma+de+Baja+Californa+Facultad+de+Ciencias+Humanas!3m1!1s0x80d7709fbfec3f63:0xa21a83286b3b40c4" id="mapa" target="_blank">Mapa</a>
				</div>
				<div class="grid_4 push_2">
					<fieldset>
						<h5>Teléfonos</h5>
						<h4>(686) 557 92 00 y (686) 557 84 88</h4>
					</fieldset>
					<fieldset>
						<h4>Dr. Jesús Adolfo Soto Curiel</h4>
						<strong>Director</strong>
						<a href="mailto:adolfo.soto@uabc.edu.mx">adolfo.soto@uabc.edu.mx</a>
					</fieldset>
					<fieldset>
						<h4>Dra. Maura Hirales Pacheco</h4>
						<strong>Subdirectora</strong>
						<a href="mailto:maurahirales@uabc.edu.mx">maurahirales@uabc.edu.mx</a>
					</fieldset>
					<span>Todos los derechos reservados <span>2015</span>.</span>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascript/funciones.js"></script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4233855-2', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>