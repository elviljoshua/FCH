<?php
/**
 * Templete para resultados de búsqueda
 *
 * @package WordPress
 * @subpackage Catarsis
 * @since Catarsis 1.0
 */
get_header();
?>
	<div id="contenidos-single" class="grid_12 resultados-busqueda">
		<h2>Resultados para: <strong><?php the_search_query(); ?></strong></h2>
	<?php
	if ( have_posts() ) : 
		while ( have_posts() ) : the_post();
		$colores = array('amarillo', 'azul', 'rojo', 'teal', 'verde', 'gris');
		$posicion = array_rand($colores);
		$color = $colores[$posicion];
		if(get_post_type() == 'archivo') {
			$archivo = rwmb_meta('archivo-archivo', array('type' => 'file'));
			$archivo = $archivo[key($archivo)]['url'];
		}
		?>
			<a href="<?php echo (get_post_type() != 'archivo' ? get_the_permalink() : $archivo); ?>" <?php echo (get_post_type() == 'archivo' ? 'target="_blank"' : ''); ?> class="resultado-busqueda <?php echo $color; ?>" <?php if(get_post_type() == 'page' || get_post_type() == 'licenciatura') { echo 'style="background-image: url(' . get_image_url(get_the_post_thumbnail(get_the_ID(), 'portada-publicacion')) . ');"';} ?>>
			<?php if(get_post_type() == 'page' || get_post_type() == 'licenciatura') :?><span><?php endif; ?>
				<h3><?php the_title(); ?></h3>
				<p><?php echo wp_trim_excerpt(get_the_excerpt()); ?></p>
				<?php if(get_post_type() == 'page' || get_post_type() == 'licenciatura') :?></span><?php endif; ?>
				<?php echo (get_post_type() == 'archivo' ? '<div></div>' : '') ?>
			</a>
		<?php
		endwhile;
	else :
		echo "No hay resultados para mostrar.";
	endif;
	?>
	</div>
<?php
get_footer();
