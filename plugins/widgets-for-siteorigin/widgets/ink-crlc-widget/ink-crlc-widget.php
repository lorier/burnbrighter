<?php

/*
Widget Name: Inked Circle Counter
Description: Animated circles to display your stats.
Author: wpinked
Author URI: https://wpinked.com
*/

class Inked_Circle_Counter_SO_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'ink-circle-count',

			__('Inked Circle Counter', 'wpinked-widgets'),

			array(
				'description' => __('Animated circles to display your stats.', 'wpinked-widgets'),
				'help' => 'http://docs.wpinked.com/widgets-for-siteorigin/circle-counter-widget'
			),

			array(
			),

			array(

				'admin' => array(
					'type' => 'text',
					'label' => __('Admin Label', 'wpinked-widgets'),
					'default' => ''
				),

				'circle' => array(
					'type' => 'section',
					'label' => __( 'Circle Settings' , 'wpinked-widgets' ),
					'hide' => true,
					'fields' => array(

						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'wpinked-widgets'),
							'default' => ''
						),

						'title-pos' => array(
							'type' => 'select',
							'label' => __('Title Position', 'wpinked-widgets'),
							'default' => 'above',
							'options' => array(
								'above' => __('Above', 'wpinked-widgets'),
								'below' => __('Below', 'wpinked-widgets')
							),
						),

						'percent' => array(
							'type' => 'slider',
							'label' => __( 'Percentage', 'wpinked-widgets' ),
							'default' => 50,
							'min' => 0,
							'max' => 100,
							'integer' => true
						),

						'percent-show' => array(
							'type' => 'checkbox',
							'label' => __( 'Show Percentage ?', 'wpinked-widgets' ),
							'default' => true
						),

						'percent-prefix' => array(
							'type' => 'text',
							'label' => __( 'Percentage Prefix', 'wpinked-widgets' ),
							'default' => ''
						),

						'percent-suffix' => array(
							'type' => 'text',
							'label' => __( 'Percentage Suffix', 'wpinked-widgets' ),
							'default' => ''
						),

					)
				),

				'styling' => array(
					'type' => 'section',
					'label' => __( 'Styling' , 'wpinked-widgets' ),
					'hide' => true,
					'fields' => array(

						'title' => array(
							'type' => 'color',
							'label' => __( 'Title Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'percent' => array(
							'type' => 'color',
							'label' => __( 'Percentage Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'percent-size' => array(
							'type' => 'text',
							'label' => __( 'Percentage Size', 'wpinked-widgets' ),
							'default' => '',
							'description' => __( 'Enter the units, eg: px, em, rem, ...', 'wpinked-widgets' ),
						),

						'bar' => array(
							'type' => 'color',
							'label' => __( 'Bar Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'track' => array(
							'type' => 'color',
							'label' => __( 'Bar Background Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'shape' => array(
							'type' => 'select',
							'label' => __('Bar Shape', 'wpinked-widgets'),
							'default' => 'butt',
							'options' => array(
								'butt' => __('Butt', 'wpinked-widgets'),
								'round' => __('Round', 'wpinked-widgets'),
								'square' => __('Square', 'wpinked-widgets'),
							),
						),

						'width' => array(
							'type' => 'number',
							'label' => __( 'Bar Width', 'wpinked-widgets' ),
							'default' => '3',
							'description' => __( 'Value in px.', 'wpinked-widgets' ),
						),

						'size' => array(
							'type' => 'number',
							'label' => __( 'Bar Size', 'wpinked-widgets' ),
							'default' => '200',
							'description' => __( 'Value in px.', 'wpinked-widgets' ),
						),

					)
				),
			),

			//The $base_folder path string.
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'circle';
	}

	function get_style_name($instance) {
		return 'circle';
	}

	function enqueue_frontend_scripts( $instance ) {

		wp_enqueue_script( 'iw-countto-js' );

		wp_register_script( 'iw-circle-js', siteorigin_widget_get_plugin_dir_url('ink-circle-count') . 'scripts/easypie.js', array( 'iw-waypoint-js' ), INKED_SO_WIDGETS, true );

		wp_enqueue_script( 'iw-circle-init', siteorigin_widget_get_plugin_dir_url('ink-circle-count') . 'scripts/circle.init.js', array( 'iw-circle-js' ), INKED_SO_WIDGETS, true );

		parent::enqueue_frontend_scripts( $instance );
	}

	function get_less_variables($instance) {
		if( empty( $instance ) ) return array();

		return array(
			'title' => $instance['styling']['title'],
			'percent' => $instance['styling']['percent'],
			'per-size' => $instance['styling']['percent-size'],
			'size' => $instance['styling']['size'],
		);
	}

}

siteorigin_widget_register('ink-circle-count', __FILE__, 'Inked_Circle_Counter_SO_Widget');
