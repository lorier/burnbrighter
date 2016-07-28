<?php

/*
Plugin Name: Tiny Whale Testimonial Carousel
Description: A Widget that creates a carousel of testimonials.
Author: Tiny Whale Creative
Author URI: http://tinywhalecreative.com
*/

//Reference : https://github.com/siteorigin/so-dev-examples

define('TW_BUNDLE_VERSION', '1.6.4');
define('TW_BUNDLE_BASE_FILE', __FILE__);

// Allow JS suffix to be pre-set
if( !defined( 'TW_BUNDLE_JS_SUFFIX' ) ) {
	define('TW_BUNDLE_JS_SUFFIX', '.min');
}


function tw_widgets($folders){
	$folders[] = plugin_dir_path(__FILE__).'/tw-widgets/';
	// echo(plugin_dir_url(__FILE__));
	return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'tw_widgets');