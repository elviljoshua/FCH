<?php
	//CORRECCIÓN AL PROBLEMA DE RENDER DEL MENÚ ADMIN EN CHROME 45
	function admin_menu_fix() {
		echo '<style>
		#adminmenu { transform: translateZ(0); }
		</style>';
	}
	add_action('admin_head', 'admin_menu_fix');
	
	function change_wp_search_size($query) {
		if ( $query->is_search )
		{
			$query->query_vars['posts_per_page'] = -1;
			$query->query_vars['orderby'] = 'title';
			$query->query_vars['order'] = 'ASC';
		}
		return $query;
	}
	add_filter('pre_get_posts', 'change_wp_search_size');
	
	//SOPORTE PARA THUMBNAILS
	add_theme_support('post-thumbnails');
	
	add_action( 'after_setup_theme', 'theme_setup' );
	function theme_setup() {
		add_image_size('portada-publicacion', 940, 500, array('left', 'bottom'));
		add_image_size('imagen-lateral', 270, 200, true);
		set_post_thumbnail_size(100, 100, true);
	}
	
	//MODIFICANDO LA HOJA DE ESTILOS Y EL DIRECTORIO PREDETERMINADOS
	
	add_filter('stylesheet_directory_uri','wpi_stylesheet_dir_uri', 10, 2);
	/**
	 * wpi_stylesheet_dir_uri
	 * overwrite theme stylesheet directory uri
	 * filter stylesheet_directory_uri
	 * @see get_stylesheet_directory_uri()
	 */
	function wpi_stylesheet_dir_uri($stylesheet_dir_uri, $theme_name)
	{
		$subdir = '/css';
		return $stylesheet_dir_uri . $subdir;
	}

	add_filter('stylesheet_uri', 'wpi_stylesheet_uri', 10, 2);
	/**
	 * wpi_stylesheet_uri
	 * overwrite default theme stylesheet uri
	 * filter stylesheet_uri
	 * @see get_stylesheet_uri()
	 */
	function wpi_stylesheet_uri($stylesheet_uri, $stylesheet_dir_uri)
	{
		return $stylesheet_dir_uri . '/estilos.css';
	}
	
	//AGREGANDO ESTILOS PERSONALIZADOS PARA EL EDITOR
	function wpb_mce_buttons_2($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	add_filter('mce_buttons_2', 'wpb_mce_buttons_2');
	
	function my_mce_before_init_insert_formats( $init_array ) { 
		$style_formats = array( 
			array( 
				'title' => 'Mosaico rojo', 
				'block' => 'div', 
				'classes' => 'link-mosaico-rojo',
				'wrapper' => true
			),
			array( 
				'title' => 'Mosaico gris', 
				'block' => 'div', 
				'classes' => 'link-mosaico-gris',
				'wrapper' => true
			),
			array( 
				'title' => 'Mosaico azul', 
				'block' => 'div', 
				'classes' => 'link-mosaico-azul',
				'wrapper' => true
			),
			array( 
				'title' => 'Mosaico gris oscuro', 
				'block' => 'div', 
				'classes' => 'link-mosaico-gris-oscuro',
				'wrapper' => true
			),
			array( 
				'title' => 'Mosaico verde', 
				'block' => 'div', 
				'classes' => 'link-mosaico-verde',
				'wrapper' => true
			),
			array( 
				'title' => 'Mosaico amarillo', 
				'block' => 'div', 
				'classes' => 'link-mosaico-amarillo',
				'wrapper' => true
			),
			array( 
				'title' => 'Mosaico azul verde', 
				'block' => 'div', 
				'classes' => 'link-mosaico-teal',
				'wrapper' => true
			),
			array( 
				'title' => 'Académico', 
				'block' => 'div', 
				'classes' => 'academico',
				'wrapper' => true
			),
		); 
		$init_array['style_formats'] = json_encode( $style_formats ); 
		return $init_array; 
	}
	add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

	function my_theme_add_editor_styles() {
		add_editor_style('custom-editor-style.css');
	}
	add_action('init', 'my_theme_add_editor_styles');
	
	//REGISTRO DE MENÚS
	register_nav_menu('la-facultad','La Facultad');
	register_nav_menu('oferta-educativa','Oferta Educativa');
	register_nav_menu('estudiantes','Estudiantes');
	register_nav_menu('vinculacion','Vinculación');
	
	//POSTS ESPECIALES
	registrar_post('noticia principal', 'noticias principales', 'post', $campos = array('title', 'editor', 'thumbnail', 'excerpt'));
	registrar_post('noticia destacada', 'noticias destacadas', 'post', $campos = array('title', 'editor', 'thumbnail', 'excerpt'));
	registrar_post('licenciatura', 'licenciaturas', 'post', $campos = array('title', 'editor', 'thumbnail', 'excerpt'));
	registrar_post('archivo', 'archivos', 'post', $campos = array('title', 'excerpt'));
	
	//LIMITANDO EL TAMAÑO DEL EXTRACTO
	function custom_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	//FUNCION PARA MOSTRAR MENÚS NAV CON BOTON DESENCADENADOR
	function mostrar_menu($ubicacion, $menu, $alinear_derecha = false) {
		if($alinear_derecha)
			$contenedor = '<div id="menu-' . $ubicacion . '" class="alinear-menu-derecha"><span>' . $menu . '</span>';
		else
			$contenedor = '<div id="menu-' . $ubicacion . '"><span>' . $menu . '</span>';
		$cierre = '</div>';
		$menu_generado = strip_tags(wp_nav_menu(array(
								'theme_location'=>	$ubicacion,
								'menu'			=>	$menu,
								'container'		=>	'',
								'items_wrap'	=>	'<nav>%3$s</nav>',
								'echo'			=>	false
						)), '<a><nav>');
		return $contenedor . $menu_generado . $cierre;
	}
	
	//FUNCION PARA ESCALAR IMÁGENES AL VUELO
	function imagen_al_vuelo($post_id, $size = 'thumbnail', $force = false) {
		$attachment_id = get_post_thumbnail_id($post_id);
		$attachment_meta = wp_get_attachment_metadata($attachment_id);
		$sizes = array_keys($attachment_meta['sizes']);
		if ( in_array($size, $sizes) && !$force )
			$ruta = wp_get_attachment_image_src($attachment_id, $size);
		else {
			include_once ABSPATH . '/wp-admin/includes/image.php';
			$generated = wp_generate_attachment_metadata($attachment_id, get_attached_file($attachment_id));
			$updated = wp_update_attachment_metadata($attachment_id, $generated);
			$ruta = wp_get_attachment_image_src($attachment_id, $size);
		}
		return $ruta[0];
	}
	
	function get_image_url($img) {
		$doc = new DOMDocument();
		$doc->loadHTML($img);
		$url = '';
		$imageTags = $doc->getElementsByTagName('img');
		foreach($imageTags as $tag) {
			$url = $tag->getAttribute('src');
		}
		return $url;
	}
	
	//CAMBIANDO COMPRESIÓN DE JPG
	add_filter( 'jpeg_quality', create_function( '', 'return 90;' ) );
	
	//FUNCIÓN PARA REGISTRAR POST TYPE CON OPCIÓN DE AGREGAR SOPORTE PARA CATEGORÍA
	function registrar_post($nombre, $plural, $tipo = 'post', $campos = array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'custom-fields', 'comments', 'revisions'), $incluir_categorias = false) {
		$labels = array(
			'name'               => __( ucwords($nombre) ),
			'singular_name'      => __( ucwords($nombre) ),
			'menu_name'          => __( ucwords($nombre) ),
			'name_admin_bar'     => __( ucwords($nombre) ),
			'add_new'            => __( 'Añadir ' . $nombre ),
			'add_new_item'       => __( 'Añadir ' . $nombre ),
			'new_item'           => __( 'Crear ' . $nombre ),
			'edit_item'          => __( 'Editar ' . $nombre ),
			'view_item'          => __( 'Ver ' . $nombre ),
			'all_items'          => __( 'Ver todo' ),
			'search_items'       => __( 'Buscar ' . $plural ),
			'parent_item_colon'  => __( ucwords($plural) . ':' ),
			'not_found'          => __( 'No existen ' . $plural . '.' ),
			'not_found_in_trash' => __( 'No existen ' . $plural . 'en la papelera.' ),
		);
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => $tipo,
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'taxonomies'         => array('category'),
			'supports'           => $campos
		);
		register_post_type( $nombre, $args );
		if($incluir_categorias) {
			$labels = array(
				'name'              => _x( 'Categories', 'taxonomy general name' ),
				'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Categories' ),
				'all_items'         => __( 'All Categories' ),
				'parent_item'       => __( 'Parent Category' ),
				'parent_item_colon' => __( 'Parent Category:' ),
				'edit_item'         => __( 'Edit Category' ),
				'update_item'       => __( 'Update Category' ),
				'add_new_item'      => __( 'Add New Category' ),
				'new_item_name'     => __( 'New Category Name' ),
				'menu_name'         => __( 'Categories' ),
			);
			$args = array(
				'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'categories' ),
			);
			register_taxonomy( 'categorias_' . $nombre, array( $nombre ), $args );
		}
	}
	
	//FUNCIÓN PARA CAMBIAR EL LOGO DE LA PANTALLA DE LOGIN
	function login_logo() { ?>
	<style type="text/css">
		body.login {
			background-color: #ffffff;
		}
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/../imagenes/svg/logo-pie.svg);
			margin-bottom: 30px;
			width: 180px;
			height: 140px;
			background-size: 180px 140px;
		}
	</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'login_logo' );
	
	//CREANDO METABOXES
	add_filter('rwmb_meta_boxes', 'your_prefix_register_meta_boxes');

	function your_prefix_register_meta_boxes( $meta_boxes )
	{
		$prefix = 'licenciatura-';
		$meta_boxes[] = array(
			'id'         => 'sintesis',
			'title'      => __('Síntesis', 'meta-box'),
			'post_types' => array('licenciatura'),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => array(
				array(
					'name'    => __('Descripción', 'meta-box'),
					'id'      => "{$prefix}sintesis-descripcion",
					'type'    => 'wysiwyg',
					'raw'     => false,
					'options' => array(
						'textarea_rows' => 6,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name'             => __('Imagen', 'meta-box'),
					'id'               => "{$prefix}sintesis-imagen",
					'type'             => 'image_advanced',
					'desc'			   => 'Imagen con medida de 270x200 pixeles.',
					'max_file_uploads' => 1,
				),
			)
		);
		$meta_boxes[] = array(
			'id'         => 'perfil-de-ingreso',
			'title'      => __('Perfil de ingreso', 'meta-box'),
			'post_types' => array('licenciatura'),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => array(
				array(
					'name'    => __('Descripción', 'meta-box'),
					'id'      => "{$prefix}perfil-de-ingreso-descripcion",
					'type'    => 'wysiwyg',
					'raw'     => false,
					'options' => array(
						'textarea_rows' => 6,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name'             => __('Imagen', 'meta-box'),
					'id'               => "{$prefix}perfil-de-ingreso-imagen",
					'desc'			   => 'Imagen con medida de 270x200 pixeles.',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
			)
		);
		$meta_boxes[] = array(
			'id'         => 'requisitos-perfil',
			'title'      => __('Requisitos de ingreso y perfil de egreso', 'meta-box'),
			'post_types' => array('licenciatura'),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => array(
				array(
					'name'    => __('Requisitos de ingreso', 'meta-box'),
					'id'      => "{$prefix}requisitos-perfil-requisitos-de-ingreso",
					'type'    => 'wysiwyg',
					'raw'     => false,
					'options' => array(
						'textarea_rows' => 6,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name'    => __('Perfil de egreso', 'meta-box'),
					'id'      => "{$prefix}requisitos-perfil-perfil-de-engreso",
					'type'    => 'wysiwyg',
					'raw'     => false,
					'options' => array(
						'textarea_rows' => 6,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name'             => __('Imagen', 'meta-box'),
					'id'               => "{$prefix}requisitos-perfil-imagen",
					'desc'			   => 'Esta imagen requiere 940px de ancho.',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
			)
		);
		$meta_boxes[] = array(
			'id'         => 'campo-ocupacional',
			'title'      => __('Campo ocupacional', 'meta-box'),
			'post_types' => array('licenciatura'),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => array(
				array(
					'name'    => __('Descripción', 'meta-box'),
					'id'      => "{$prefix}campo-ocupacional-descripcion",
					'type'    => 'wysiwyg',
					'raw'     => false,
					'options' => array(
						'textarea_rows' => 6,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name'             => __('Imagen', 'meta-box'),
					'id'               => "{$prefix}campo-ocupacional-imagen",
					'desc'			   => 'Imagen con medida de 270x200 pixeles.',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
			)
		);
		$meta_boxes[] = array(
			'id'         => 'mas-informacion',
			'title'      => __('Información adicional', 'meta-box'),
			'post_types' => array('licenciatura'),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => array(
				array(
					'name' => __('Correo de contacto', 'meta-box'),
					'id'   => "{$prefix}mas-informacion-correo",
					'desc' => __('Correo para el botón de contacto.', 'meta-box'),
					'type' => 'email',
				),
				array(
					'name'             => __('Archivo del plan de estudios', 'meta-box'),
					'id'               => "{$prefix}mas-informacion-plan-de-estudios",
					'type'             => 'file_advanced',
					'max_file_uploads' => 1,
					'mime_type'        => '', // Leave blank for all file types
				),
			)
		);
		$prefix = 'archivo-';
		$meta_boxes[] = array(
			'id'         => 'datos-adicionales',
			'title'      => __('Archivo relacionado', 'meta-box'),
			'post_types' => array('archivo'),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => array(
				array(
					'name'             => __('Selecciona el archivo', 'meta-box'),
					'id'               => "{$prefix}archivo",
					'type'             => 'file_advanced',
					'max_file_uploads' => 1,
					'mime_type'        => '',
				),
			)
		);
		return $meta_boxes;
	}





