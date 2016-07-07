<?php
// Adding Visibility fields to rows and widgets
add_filter( 'siteorigin_panels_row_style_fields', 'wpinked_so_visibility_fields' );
add_filter( 'siteorigin_panels_widget_style_fields', 'wpinked_so_visibility_fields' );

// Adding Visibility classes to rows and widgets
add_filter('siteorigin_panels_row_style_attributes', 'wpinked_so_visibility_attributes', 10, 2);
add_filter('siteorigin_panels_widget_style_attributes', 'wpinked_so_visibility_attributes', 10, 2);

// The functions that make it happen
function wpinked_so_visibility_fields($fields) {

	$fields['iw-visible-screen'] = array(
			'name'        => __('Visibility - By screen size', 'wpinked-widgets'),
			'type'        => 'select',
			'group'       => 'attributes',
			'default' => 'iw-all',
			'options' => array(
						'iw-all' => __( 'All', 'wpinked-widgets' ),
						'iw-small' => __( 'Small', 'wpinked-widgets' ),
						'iw-med-up' => __( 'Medium Up', 'wpinked-widgets' ),
						'iw-medium' => __( 'Medium', 'wpinked-widgets' ),
						'iw-med-dw' => __( 'Medium Down', 'wpinked-widgets' ),
						'iw-large' => __( 'Large', 'wpinked-widgets' )
			 ),
			'description' => __('Show by screen size.', 'wpinked-widgets'),
			'priority'    => 12,
	);

	$fields['iw-visible-layout'] = array(
			'name'        => __('Visibility - By screen layout', 'wpinked-widgets'),
			'type'        => 'select',
			'group'       => 'attributes',
			'default' => 'iw-all',
			'options' => array(
						'iw-all' => __( 'All', 'wpinked-widgets' ),
						'iw-show-p' => __( 'Show Portrait', 'wpinked-widgets' ),
						'iw-show-l' => __( 'Show Landscape', 'wpinked-widgets' ),
						'iw-hide-p' => __( 'Hide Portrait', 'wpinked-widgets' ),
						'iw-hide-l' => __( 'Hide Landscape', 'wpinked-widgets' )
			 ),
			'description' => __('Show based on screen orientation.', 'wpinked-widgets'),
			'priority'    => 13,
	);

	return $fields;
}

function wpinked_so_visibility_attributes( $attributes, $args ) {
    if( !empty( $args['iw-visible-screen'] ) && ( $args['iw-visible-screen'] !== 'iw-all' ) ) {
        array_push($attributes['class'], $args['iw-visible-screen']);
    }
    if( !empty( $args['iw-visible-layout'] ) && ( $args['iw-visible-screen'] !== 'iw-all' ) ) {
        array_push($attributes['class'], $args['iw-visible-layout']);
    }

    return $attributes;
}