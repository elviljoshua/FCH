<?php
/**
 * Archivo principal del template
 * @package WordPress
 * @subpackage Catarsis
 * @since Catarsis 1.0
 */

get_header(); ?>

<?php
	//OBTENIENDO LA NOTA PRINCIPAL
	$args = array( 'order'=> 'DESC', 'limit' => 1, 'posts_per_page' => 1, 'post_type' => 'noticia principal');
	query_posts($args); 
	if ( have_posts() ) :
	while ( have_posts() ) : the_post();
	?>
		<a href="<?php the_permalink(); ?>" class="portada-publicacion grid_12 noticia-principal">
			<p></p>
			<img src="<?php echo get_image_url(get_the_post_thumbnail(get_the_ID(), 'portada-publicacion')); ?>">
			<div>
				<h3><?php the_title(); ?></h3>
				<span><?php the_excerpt(); ?></span>
				<div>Más información</div>
			</div>
		</a>
	<?php
	endwhile;
	endif;
	wp_reset_query();
	//NOTICIAS DESTACADAS (LAS 3 DEBAJO DE LA NOTA PRINCIPAL)
	$args = array( 'order'=> 'DESC', 'posts_per_page' => 2, 'post_type' => 'noticia destacada');
	$contador = 1;
	query_posts($args); 
	if ( have_posts() ) :
	while ( have_posts() ) : the_post();
	?>
		<a href="<?php the_permalink(); ?>" class="grid_6 noticia-destacada">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>
			<div>
				<h4><?php the_title(); ?></h4>
				<div><?php the_excerpt(); ?></div>
				<span><svg version="1.1" viewBox="0 0 56.9 55.1"><polygon fill="#454545" points="29.4,0 22.3,7.1 37.3,22.1 0,22.1 0,32.1 38.2,32.1 22.3,48 29.4,55.1 56.9,27.5 "/></svg>Ver más</span>
			</div>
		</a>
	<?php
		$contador ++;
	endwhile;
	endif;
	wp_reset_query();
	//NOTICIAS GENERALES
	$args = array( 'order'=> 'DESC', 'posts_per_page' => 10, 'post' => 'noticia destacada');
	$contador = 1;
	query_posts($args); 
	if ( have_posts() ) :
	while ( have_posts() ) : the_post();
	?>
		<a href="<?php the_permalink(); ?>" class="noticia grid_12<?php if($contador == 1): echo ' noticia-azul'; elseif($contador==2): echo ' noticia-roja'; elseif($contador==3): echo ' noticia-amarilla'; else: echo ' noticia-menta'; endif;?>">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'portada-publicacion'); ?>
			<p></p>
			<div>
				<h3><?php the_title(); ?></h3>
				<span><?php the_excerpt(); ?></span>
			</div>
			<span>
				<div>
					<svg version="1.1" viewBox="0 0 56.9 55.1"><polygon fill="#ffffff" points="29.4,0 22.3,7.1 37.3,22.1 0,22.1 0,32.1 38.2,32.1 22.3,48 29.4,55.1 56.9,27.5 "/></svg>
					<span>LEER ARTÍCULO COMPLETO</span>
				</div>
			</span>
		</a>
	<?php
		$contador = ($contador == 4 ? 1 : $contador + 1);
	endwhile;
	endif;
	wp_reset_query();
?>
<?php
get_footer();
