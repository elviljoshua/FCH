<?php
/**
 * Templete para mostrar las licenciaturas, contiene campos especiales para todas las áreas
 *
 * @package WordPress
 * @subpackage Catarsis
 * @since Catarsis 1.0
 */

get_header();
while ( have_posts() ) : the_post();
?>
	<div id="cabecera-single" class="grid_12 cabecera-con-foto" style="background-image: url(<?php echo get_image_url(get_the_post_thumbnail(get_the_ID(), 'portada-publicacion')); ?>);">
		<span><h1><?php the_title(); ?></h1></span>
	</div>
	<div id="contenidos-single" class="grid_12">
		<div class="seccion-licenciatura">
			<div class="columna-grande">
				<h2>Síntesis</h2>
				<?php echo rwmb_meta('licenciatura-sintesis-descripcion');?>
			</div>
			<?php
				$imagen = rwmb_meta('licenciatura-sintesis-imagen', array('type' => 'image','size' => 'imagen-lateral'));
				$imagen = $imagen[key($imagen)]['url'];
			?>
			<div class="columna-foto omega" style="background-image: url(<?php echo $imagen; ?>);">Síntesis</div>
		</div>
		<div class="seccion-licenciatura">
			<?php
				$imagen = rwmb_meta('licenciatura-perfil-de-ingreso-imagen', array('type' => 'image','size' => 'imagen-lateral'));
				$imagen = $imagen[key($imagen)]['url'];
			?>
			<div class="columna-foto" style="background-image: url(<?php echo $imagen; ?>);">Síntesis</div>
			<div class="columna-grande omega">
				<h2>Requisitos de ingreso</h2>
				<?php echo rwmb_meta('licenciatura-requisitos-perfil-requisitos-de-ingreso');?>
			</div>
			<?php
				$imagen = rwmb_meta('licenciatura-requisitos-perfil-imagen', array('type' => 'image','size' => 'portada-publicacion'));
				$imagen = $imagen[key($imagen)]['url'];
			?>
			<img src="<?php echo $imagen; ?>" class="alignnone">
		</div>
		<div class="seccion-licenciatura">
			<div class="columna-mitad">
				<h2>Perfil de ingreso</h2>
				<?php echo rwmb_meta('licenciatura-perfil-de-ingreso-descripcion');?>
			</div>
			<div class="columna-mitad omega">
				<h2>Perfil de egreso</h2>
				<?php echo rwmb_meta('licenciatura-requisitos-perfil-perfil-de-engreso');?>
			</div>
		</div>
		<div class="seccion-licenciatura">
			<div class="columna-grande">
				<h2>Campo ocupacional</h2>
				<?php echo rwmb_meta('licenciatura-campo-ocupacional-descripcion');?>
			</div>
			<?php
				$imagen = rwmb_meta('licenciatura-campo-ocupacional-imagen', array('type' => 'image','size' => 'imagen-lateral'));
				$imagen = $imagen[key($imagen)]['url'];
			?>
			<div class="columna-foto omega" style="background-image: url(<?php echo $imagen; ?>);">Síntesis</div>
		</div>
		<div class="seccion-licenciatura">
			<h2>¿Necesitas más información?</h2>
			<?php
				$archivo = rwmb_meta('licenciatura-mas-informacion-plan-de-estudios', array('type' => 'file'));
				$archivo = $archivo[key($archivo)]['url'];
			?>
			<a href="<?php echo $archivo; ?>" target="_blank" class="boton-plan-de-estudios">Plan de estudios completo</a>
			<a href="mailto:<?php echo rwmb_meta('licenciatura-mas-informacion-correo'); ?>" class="boton-contactanos">Contáctanos aquí</a>
		</div>
		<div class="seccion-licenciatura cuerpo-academico">
			<?php the_content(); ?>
		</div>
		<div class="at-below-post addthis-toolbox" data-url="<?php the_permalink(); ?>" data-title="<?php the_title_attribute(); ?>"></div>
		<span id="fecha-modificacion">
			<strong>Última actualización:</strong> <?php the_modified_date(); ?>
		</span>
	</div>
<?php
endwhile;
get_footer();
