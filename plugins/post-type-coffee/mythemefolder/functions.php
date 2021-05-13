if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_609713af5ca2d',
	'title' => 'Coffee Shop Location',
	'fields' => array(
		array(
			'key' => 'field_609713bff111c',
			'label' => 'Map Location',
			'name' => 'map_location',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '',
			'center_lng' => '',
			'zoom' => '',
			'height' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'coffee',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
