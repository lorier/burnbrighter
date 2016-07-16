<?php
/**
 * Kickstart Pro
 *
 * @author  Lean Themes
 * @license GPL-2.0+
 * @link    http://demo.leanthemes.co/kickstart/
 */

add_action( 'wp_head', 'kickstart_front_page_setup' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function kickstart_front_page_setup() {

	if ( is_active_sidebar( 'home-top-header' ) || is_active_sidebar( 'home-top' ) ) {

		// Add front-page body class
		add_filter( 'body_class', 'kickstart_body_class' );
		function kickstart_body_class( $classes ) {
   			$classes[] = 'front-page';

  			return $classes;
		}

		// Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Add homepage top area
		add_action( 'genesis_after_header', 'kickstart_homepage_top' );

	}
}

// Setup homepage top area
function kickstart_homepage_top() {
	
	if ( is_active_sidebar( 'home-top-header' ) ) {
		genesis_widget_area( 'home-top-header', array(
			'before' => '<div id="top-header" class="top-header widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	}
}



genesis();
