<?php
/**
 * Templete para mostrar imágenes
 *
 * @package WordPress
 * @subpackage Catarsis
 * @since Catarsis 1.0
 */

$metadata = wp_get_attachment_metadata();

get_header();
?>

	<ul>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();    

	 $args = array(
	   'post_type' => 'attachment',
	   'numberposts' => -1,
	   'post_status' => null,
	   'post_parent' => $post->ID
	  );

	  $attachments = get_posts( $args );
		 if ( $attachments ) {
			foreach ( $attachments as $attachment ) {
			   echo '<li>';
			   echo wp_get_attachment_image( $attachment->ID, 'full' );
			   echo '<p>';
			   echo apply_filters( 'the_title', $attachment->post_title );
			   echo '</p></li>';
			  }
		 }

	 endwhile; endif; ?>
	</ul>

<?php
get_footer();
