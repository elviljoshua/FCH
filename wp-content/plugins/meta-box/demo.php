<?php

add_filter('rwmb_meta_boxes', 'your_prefix_register_meta_boxes');

function your_prefix_register_meta_boxes( $meta_boxes )
{
	$prefix = 'your_prefix_';
	$meta_boxes[] = array(
		'id'         => 'standard',
		'title'      => __('Standard Fields', 'meta-box'),
		'post_types' => array('post', 'page'),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		'fields'     => array(
			// TEXT
			array(
				'name'  => __('Text', 'meta-box'),
				'id'    => "{$prefix}text",
				'desc'  => __('Text description', 'meta-box'),
				'type'  => 'text',
				'std'   => __('Default text value', 'meta-box'),
				'clone' => true,
			),
			// CHECKBOX
			array(
				'name' => __('Checkbox', 'meta-box'),
				'id'   => "{$prefix}checkbox",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 1,
			),
			// RADIO BUTTONS
			array(
				'name'    => __('Radio', 'meta-box'),
				'id'      => "{$prefix}radio",
				'type'    => 'radio',
				// Array of 'value' => 'Label' pairs for radio options.
				// Note: the 'value' is stored in meta field, not the 'Label'
				'options' => array(
					'value1' => __('Label1', 'meta-box'),
					'value2' => __('Label2', 'meta-box'),
				),
			),
			// SELECT BOX
			array(
				'name'        => __('Select', 'meta-box'),
				'id'          => "{$prefix}select",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'value1' => __('Label1', 'meta-box'),
					'value2' => __('Label2', 'meta-box'),
				),
				'multiple'    => false,
				'std'         => 'value2',
				'placeholder' => __('Select an Item', 'meta-box'),
			),
			// HIDDEN
			array(
				'id'   => "{$prefix}hidden",
				'type' => 'hidden',
				'std'  => __('Hidden value', 'meta-box'),
			),
			// PASSWORD
			array(
				'name' => __('Password', 'meta-box'),
				'id'   => "{$prefix}password",
				'type' => 'password',
			),
			// TEXTAREA
			array(
				'name' => __('Textarea', 'meta-box'),
				'desc' => __('Textarea description', 'meta-box'),
				'id'   => "{$prefix}textarea",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
		),
		'validation' => array(
			'rules'    => array(
				"{$prefix}password" => array(
					'required'  => true,
					'minlength' => 7,
				),
			),
			'messages' => array(
				"{$prefix}password" => array(
					'required'  => __('Password is required', 'meta-box'),
					'minlength' => __('Password must be at least 7 characters', 'meta-box'),
				),
			)
		)
	);

	$meta_boxes[] = array(
		'title'  => __('Advanced Fields', 'meta-box'),
		'post_types' => array('post', 'page', 'licenciatura'),
		'fields' => array(
			// HEADING
			array(
				'type' => 'heading',
				'name' => __('Heading', 'meta-box'),
				'id'   => 'fake_id', // Not used but needed for plugin
				'desc' => __('Optional description for this heading', 'meta-box'),
			),
			// SLIDER
			array(
				'name'       => __('Slider', 'meta-box'),
				'id'         => "{$prefix}slider",
				'type'       => 'slider',
				'prefix'     => __('$', 'meta-box'),
				'suffix'     => __(' USD', 'meta-box'),
				'js_options' => array(
					'min'  => 10,
					'max'  => 255,
					'step' => 5,
				),
			),
			// NUMBER
			array(
				'name' => __('Number', 'meta-box'),
				'id'   => "{$prefix}number",
				'type' => 'number',

				'min'  => 0,
				'step' => 5,
			),
			// DATE
			array(
				'name'       => __('Date picker', 'meta-box'),
				'id'         => "{$prefix}date",
				'type'       => 'date',
				'js_options' => array(
					'appendText'      => __('(yyyy-mm-dd)', 'meta-box'),
					'dateFormat'      => __('yy-mm-dd', 'meta-box'),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
			// DATETIME
			array(
				'name'       => __('Datetime picker', 'meta-box'),
				'id'         => $prefix . 'datetime',
				'type'       => 'datetime',
				'js_options' => array(
					'stepMinute'     => 15,
					'showTimepicker' => true,
				),
			),
			// TIME
			array(
				'name'       => __('Time picker', 'meta-box'),
				'id'         => $prefix . 'time',
				'type'       => 'time',
				'js_options' => array(
					'stepMinute' => 5,
					'showSecond' => true,
					'stepSecond' => 10,
				),
			),
			// COLOR
			array(
				'name' => __('Color picker', 'meta-box'),
				'id'   => "{$prefix}color",
				'type' => 'color',
			),
			// CHECKBOX LIST
			array(
				'name'    => __('Checkbox list', 'meta-box'),
				'id'      => "{$prefix}checkbox_list",
				'type'    => 'checkbox_list',
				// Options of checkboxes, in format 'value' => 'Label'
				'options' => array(
					'value1' => __('Label1', 'meta-box'),
					'value2' => __('Label2', 'meta-box'),
				),
			),
			// AUTOCOMPLETE
			array(
				'name'    => __('Autocomplete', 'meta-box'),
				'id'      => "{$prefix}autocomplete",
				'type'    => 'autocomplete',
				'options' => array(
					'value1' => __('Label1', 'meta-box'),
					'value2' => __('Label2', 'meta-box'),
				),
				'size'    => 30,
				'clone'   => false,
			),
			// EMAIL
			array(
				'name' => __('Email', 'meta-box'),
				'id'   => "{$prefix}email",
				'desc' => __('Email description', 'meta-box'),
				'type' => 'email',
				'std'  => 'name@email.com',
			),
			// RANGE
			array(
				'name' => __('Range', 'meta-box'),
				'id'   => "{$prefix}range",
				'desc' => __('Range description', 'meta-box'),
				'type' => 'range',
				'min'  => 0,
				'max'  => 100,
				'step' => 5,
				'std'  => 0,
			),
			// URL
			array(
				'name' => __('URL', 'meta-box'),
				'id'   => "{$prefix}url",
				'desc' => __('URL description', 'meta-box'),
				'type' => 'url',
				'std'  => 'http://google.com',
			),
			// OEMBED
			array(
				'name' => __('oEmbed', 'meta-box'),
				'id'   => "{$prefix}oembed",
				'desc' => __('oEmbed description', 'meta-box'),
				'type' => 'oembed',
			),
			// SELECT ADVANCED BOX
			array(
				'name'        => __('Select', 'meta-box'),
				'id'          => "{$prefix}select_advanced",
				'type'        => 'select_advanced',
				'options'     => array(
					'value1' => __('Label1', 'meta-box'),
					'value2' => __('Label2', 'meta-box'),
				),
				'multiple'    => false,
				// 'std'         => 'value2', // Default value, optional
				'placeholder' => __('Select an Item', 'meta-box'),
			),
			// TAXONOMY
			array(
				'name'    => __('Taxonomy', 'meta-box'),
				'id'      => "{$prefix}taxonomy",
				'type'    => 'taxonomy',
				'options' => array(
					'taxonomy' => 'category',
					// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
					'type'     => 'checkbox_list',
					'args'     => array()
				),
			),
			// POST
			array(
				'name'        => __('Posts (Post)', 'meta-box'),
				'id'          => "{$prefix}post",
				'type'        => 'post',
				'post_type'   => 'post',
				// Field type, either 'select' or 'select_advanced' (default)
				'field_type'  => 'select_advanced',
				'placeholder' => __('Select an Item', 'meta-box'),
				// Query arguments (optional). No settings means get all published posts
				'query_args'  => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				)
			),
			// WYSIWYG/RICH TEXT EDITOR
			array(
				'name'    => __('WYSIWYG / Rich Text Editor', 'meta-box'),
				'id'      => "{$prefix}wysiwyg",
				'type'    => 'wysiwyg',
				// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
				'raw'     => false,
				'std'     => __('WYSIWYG default value', 'meta-box'),
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				),
			),
			// DIVIDER
			array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
			// FILE UPLOAD
			array(
				'name' => __('File Upload', 'meta-box'),
				'id'   => "{$prefix}file",
				'type' => 'file',
			),
			// FILE ADVANCED (WP 3.5+)
			array(
				'name'             => __('File Advanced Upload', 'meta-box'),
				'id'               => "{$prefix}file_advanced",
				'type'             => 'file_advanced',
				'max_file_uploads' => 4,
				'mime_type'        => 'application,audio,video', // Leave blank for all file types
			),
			// IMAGE UPLOAD
			array(
				'name' => __('Image Upload', 'meta-box'),
				'id'   => "{$prefix}image",
				'type' => 'image',
			),
			// THICKBOX IMAGE UPLOAD (WP 3.3+)
			array(
				'name' => __('Thickbox Image Upload', 'meta-box'),
				'id'   => "{$prefix}thickbox",
				'type' => 'thickbox_image',
			),
			// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
			array(
				'name'             => __('Plupload Image Upload', 'meta-box'),
				'id'               => "{$prefix}plupload",
				'type'             => 'plupload_image',
				'max_file_uploads' => 4,
			),
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => __('Image Advanced Upload', 'meta-box'),
				'id'               => "{$prefix}imgadv",
				'type'             => 'image_advanced',
				'max_file_uploads' => 4,
			),
			// BUTTON
			array(
				'id'   => "{$prefix}button",
				'type' => 'button',
				'name' => ' ', // Empty name will "align" the button to all field inputs
			),
		)
	);
	return $meta_boxes;
}