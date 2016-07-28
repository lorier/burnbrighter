<?php

/*
Widget Name: Tiny Whale Testimonial Carousel
Description: A Widget that creates a carousel of testimonials.
Author: Tiny Whale Creative
Author URI: http://tinywhalecreative.com
*/

define('TW_WIDGETS', '0.0.1');

/**
 * Add the carousel image sizes
 */
function tw_carousel_register_image_sizes(){
	add_image_size('tw-carousel-default', 130, 130, true);
}
add_action('init', 'tw_carousel_register_image_sizes');

function tw_carousel_get_next_posts_page() {
	if ( empty( $_REQUEST['_widgets_nonce'] ) || !wp_verify_nonce( $_REQUEST['_widgets_nonce'], 'widgets_action' ) ) return;
	$query = wp_parse_args(
		siteorigin_widget_post_selector_process_query($_GET['query']),
		array(
			'post_status' => 'publish',
			'post_type' => 'testimonial',
			'posts_per_page' => 10,
			'paged' => empty( $_GET['paged'] ) ? 1 : $_GET['paged']
		)
	);

	$posts = new WP_Query($query);
	ob_start();
	include 'tpl/carousel-post-loop.php';
	$result = array( 'html' => ob_get_clean() );
	header('content-type: application/json');
	echo json_encode( $result );

	exit();
}
add_action( 'wp_ajax_tw_carousel_load', 'tw_carousel_get_next_posts_page' );
add_action( 'wp_ajax_nopriv_tw_carousel_load', 'tw_carousel_get_next_posts_page' );

class Tw_Testimonial_Widget extends SiteOrigin_Widget {
	function __construct() {
		//extends class here: /Applications/MAMP/htdocs/sowtestplugin/wp-content/plugins/so-widgets-bundle/base/siteorigin-widget.class.php:
		parent::__construct(
			//id
			'tw-testimonial-widget',
			//name
			__('Tiny Whale Testimonial Widget', 'tw-widgets-domain'),
			//widget_options
			array(
				'description' => __('Display your posts as a carousel.', 'tw-widgets-domain'),
				'help' => 'https://siteorigin.com/widgets-bundle/post-carousel-widget/'
			),
			//control options
			array(

			),
			//form options
			false,
			//base folder
			plugin_dir_path(__FILE__)
		);
	}

	function initialize() {
		$this->register_frontend_scripts(
			array(
				array(
					'touch-swipe',
					plugin_dir_url( TW_BUNDLE_BASE_FILE ) . 'js/jquery.touchSwipe' . TW_BUNDLE_JS_SUFFIX . '.js',
					array( 'jquery' ),
					'1.6.6'
				),
				array(
					'tw-carousel-basic',
					plugin_dir_url(__FILE__) . 'js/tw-carousel.js',
					array( 'jquery', 'touch-swipe' ),
					TW_BUNDLE_VERSION,
					true
				)
			)
		);
		$this->register_frontend_styles(
			array(
				array(
					'tw-carousel-basic',
					plugin_dir_url(__FILE__) . 'css/style.css',
					array(),
					TW_BUNDLE_VERSION
				)
			)
		);
	}

	function initialize_form(){
		return array(
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'tw-widgets-domain'),
			),

			'posts' => array(
				'type' => 'posts',
				'label' => __('Posts query', 'tw-widgets-domain'),
			),
		);
	}

	function get_template_name($instance){
		return 'base';
	}

	function get_style_name($instance){
		return false;
	}
}

siteorigin_widget_register('tw-testimonial-widget', __FILE__, 'Tw_Testimonial_Widget');