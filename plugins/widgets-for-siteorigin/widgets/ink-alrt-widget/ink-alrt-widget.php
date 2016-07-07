<?php 

/*
Widget Name: Inked Alert
Description: Communicate success, warnings, failure or just information.
Author: wpinked
Author URI: https://wpinked.com
*/

class Inked_Alert_SO_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(

			'ink-alert',

			__('Inked Alert', 'wpinked-widgets'),

			array(
				'description' => __('Communicate success, warnings, failure or just information.', 'wpinked-widgets'),
				'help' => 'http://docs.wpinked.com/widgets-for-siteorigin/alert-widget'
			),

			array(
			),

			array(

				'message' => array(
					'type' => 'text',
					'label' => __('Message', 'wpinked-widgets'),
					'default' => 'This is an Alert Message'
				),

				'close' => array(
					'type' => 'checkbox',
					'label' => __( 'Show Close Button ?', 'wpinked-widgets' ),
					'default' => true
				),

				'icon' => array(
					'type' => 'section',
					'label' => __( 'Icon' , 'wpinked-widgets' ),
					'hide' => true,
					'fields' => array(

						'select' => array(
							'type' => 'icon',
							'label' => __('Icon', 'wpinked-widgets'),
						),
						'color' => array(
							'type' => 'color',
							'label' => __( 'Icon Color', 'wpinked-widgets' ),
							'default' => ''
						),
					)
				),

				'styling' => array(
					'type' => 'section',
					'label' => __( 'Styling' , 'wpinked-widgets' ),
					'hide' => true,
					'fields' => array(

						'theme' => array(
							'type' => 'select',
							'label' => __('Theme', 'wpinked-widgets'),
							'default' => 'classic',
							'options' => array(
								'classic' => __('Classic', 'wpinked-widgets'),
								'flat' => __('Flat', 'wpinked-widgets'),
								'outline' => __('Outline', 'wpinked-widgets'),
								'threed' => __('3D', 'wpinked-widgets'),
								'shadow' => __('Shadow', 'wpinked-widgets'),
								'modern' => __('Modern', 'wpinked-widgets'),
							),
						),
						
						'background' => array(
							'type' => 'color',
							'label' => __( 'Background Color', 'wpinked-widgets' ),
							'default' => ''
						),                        

						'text' => array(
							'type' => 'color',
							'label' => __( 'Text Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'close' => array(
							'type' => 'color',
							'label' => __( 'Close Color', 'wpinked-widgets' ),
							'default' => ''
						),

						'corners' => array(
							'type' => 'select',
							'label' => __('Corners', 'wpinked-widgets'),
							'default' => '0.25em',
							'options' => array(
								'0em' => __('Sharp', 'wpinked-widgets'),
								'0.25em' => __('Slightly curved', 'wpinked-widgets'),
								'0.75em' => __('Highly curved', 'wpinked-widgets'),
							),
						),

						'size' => array(
							'type' => 'select',
							'label' => __('Size', 'wpinked-widgets'),
							'default' => 'standard',
							'options' => array(
								'small' => __('Small', 'wpinked-widgets'),
								'standard' => __('Standard', 'wpinked-widgets'),
								'large' => __('Large', 'wpinked-widgets'),
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
		return 'alert';
	}

	function get_style_name($instance) {
		return 'alert';
	}

	function enqueue_frontend_scripts( $instance ) {

		wp_register_script( 'iw-alert-js', siteorigin_widget_get_plugin_dir_url('ink-alert') . 'scripts/alert.js', array( 'iw-foundation-js' ), INKED_SO_WIDGETS, true );

		wp_enqueue_script( 'iw-alert-init', siteorigin_widget_get_plugin_dir_url('ink-alert') . 'scripts/alert.init.js', array( 'iw-alert-js' ), INKED_SO_WIDGETS, true );

		wp_enqueue_style( 'iw-alert', siteorigin_widget_get_plugin_dir_url('ink-alert') . 'styles/alert.css', array(), INKED_SO_WIDGETS );

		parent::enqueue_frontend_scripts( $instance );
	}

	function get_less_variables($instance) {
		if( empty( $instance ) ) return array();

		return array(
			'radius' => $instance['styling']['corners'],
			'size' => $instance['styling']['size'],
			'text' => $instance['styling']['text'],
			'bg' => $instance['styling']['background'],
			'theme' => $instance['styling']['theme'],
			'close' => $instance['styling']['close'],
		);
	}

}

siteorigin_widget_register('ink-alert', __FILE__, 'Inked_Alert_SO_Widget');