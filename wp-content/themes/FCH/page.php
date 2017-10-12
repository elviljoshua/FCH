<?php
/**
 * Templete para mostrar las páginas
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
		<?php the_content(); ?>
		<span id="fecha-modificacion">
			<strong>Última actualización:</strong> <?php the_modified_date(); ?>
		</span>
	</div>
<?php
endwhile;
get_footer();
