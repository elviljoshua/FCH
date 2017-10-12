<?php
/**
 * Templete para mostrar los Single Post
 *
 * @package WordPress
 * @subpackage Catarsis
 * @since Catarsis 1.0
 */

get_header();
$colores = array('amarillo', 'azul', 'rojo', 'teal', 'verde', 'gris');
$posicion = array_rand($colores);
$color = $colores[$posicion];

while ( have_posts() ) : the_post();
?>
	<div id="cabecera-single" class="grid_12 cabecera-con-foto" style="background-image: url(<?php echo get_image_url(get_the_post_thumbnail(get_the_ID(), 'portada-publicaion')); ?>);">
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
