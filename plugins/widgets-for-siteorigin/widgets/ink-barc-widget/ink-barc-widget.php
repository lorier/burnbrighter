<?php

/*
Widget Name: Inked Bar Counter
Description: Animated bars to display your stats.
Author: wpinked
Author URI: https://wpinked.com
*/

class Inked_Bar_Counter_SO_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'ink-bar-count',

			__('Inked Bar Counter', 'wpinked-widgets'),

			array(
				'description' => __('Animated bars to display your stats.', 'wpinked-widgets'),
				'help' => 'http://docs.wpinked.com/widgets-for-siteorigin/bar-counter-widget'
			),

			array(
			),

			array(

				'admin' => array(
					'type' => 'text',
					'label' => __('Admin Label', 'wpinked-widgets'),
					'default' => ''
				),

				'bars' => array(
					'type' => 'repeater',
					'label' => __( 'Bars' , 'wpinked-widgets' ),
					'item_name'  => __( 'Bar', 'wpinked-widgets' ),
					'item_label' => array(
						'selector'     => "[id*='title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(

						'title' => array(
							'type' => 'text',
							'label' => __('Title', 'wpinked-widgets'),
							'default' => ''
						),

						'percent' => array(
							'type' => 'slider',
							'label' => __( 'Percentage', 'wpinked-widgets' ),
							'default' => 50,
							'min' => 0,
							'max' => 100,
							'integer' => true
						),

					)

				),

				'styling' => array(
					'type' => 'section',
					'label' => __( 'Styling' , 'wpinked-widgets' ),
					'hide' => true,
					'fields' => array(

						'height' => array(
							'type' => 'text',
							'label' => __( 'Height', 'wpinked-widgets' ),
							'default' => '25px',
							'description' => __( 'Enter the units, eg: px, em, rem, ...', 'wpinked-widgets' ),
						),

						'percent-show' => array(
							'type' => 'checkbox',
							'label' => __( 'Show Percentage ?', 'wpinked-widgets' ),
							'default' => true
						),

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

						'bar-bg' => array(
							'type' => 'color',
							'label' => __( 'Bar Background Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'bar' => array(
							'type' => 'color',
							'label' => __( 'Bar Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'border' => array(
							'type' => 'checkbox',
							'label' => __( 'Show Border ?', 'wpinked-widgets' ),
							'default' => true
						),

						'border-clr' => array(
							'type' => 'color',
							'label' => __( 'Border Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'corners' => array(
							'type' => 'select',
							'label' => __('Corners', 'wpinked-widgets'),
							'default' => '0.25em',
							'options' => array(
								'0em' => __('Sharp', 'wpinked-widgets'),
								'0.25em' => __('Curved', 'wpinked-widgets'),
								'0.75em' => __('Round', 'wpinked-widgets'),
							),
						),

					)
				),
			),

			//The $base_folder path string.
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'bar';
	}

	function get_style_name($instance) {
		return 'bar';
	}

	function enqueue_frontend_scripts( $instance ) {

		wp_enqueue_script( 'iw-bar-js', siteorigin_widget_get_plugin_dir_url('ink-bar-count') . 'scripts/bar.js', array( 'iw-waypoint-js' ), INKED_SO_WIDGETS, true );

		parent::enqueue_frontend_scripts( $instance );
	}

	function get_less_variables($instance) {
		if( empty( $instance ) ) return array();

		return array(
			'radius' => $instance['styling']['corners'],
			'height' => $instance['styling']['height'],
			'title' => $instance['styling']['title'],
			'percent' => $instance['styling']['percent'],
			'bar-bg' => $instance['styling']['bar-bg'],
			'bar' => $instance['styling']['bar'],
			'border' => $instance['styling']['border'],
			'bor-clr' => $instance['styling']['border-clr'],
		);
	}

}

siteorigin_widget_register('ink-bar-count', __FILE__, 'Inked_Bar_Counter_SO_Widget');
