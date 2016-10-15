<?php
/**
 * Template Name: Member Dashboard
 *
 * @author  Lorie Ransom
 * @license GPL-2.0+
 * @link    http://tinywhalecreative.com
 */
remove_action('genesis_sidebar', 'genesis_do_sidebar');

//remove site header markup
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

//remove all standard navigation
remove_action( 'genesis_header', 'tw_secondary_nav', 5 );
remove_action( 'genesis_header_right','genesis_do_nav' );
remove_action( 'genesis_footer', 'sp_custom_footer', 11 );
remove_action( 'genesis_footer', 'genesis_footer_widget_areas' );
remove_action ('genesis_footer','tw_footerwidgetheader_position',4);
remove_action('genesis_footer', 'genesis_do_footer');
// remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
// remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

//add custom body class to these pages
add_filter( 'body_class', 'tw_body_class' );
function tw_body_class( $classes ) {
	
	$classes[] = 'member-dashboard';
	return $classes;
}
add_action('genesis_before_header', 'tw_program_header');
function tw_program_header(){
	$current_user = wp_get_current_user();
 	if ( !($current_user instanceof WP_User) ) {
     	return;
 	}else {
 		$output = '<div class="member-header">';
 		$output .= '<div class="wrap"><div class="one-fourth first hero-image mobile-hidden"><img src="'.get_stylesheet_directory_uri().'/images/breanne-leaning-into.jpg"></div>';
 		$output .= '<div class="three-fourths"><div class="title-text"><h1 class="member-welcome-title">Welcome to Burn Brighter! </h1></div></div></div>';
 		$output .= '</div>';
		echo $output;
 	}
 
}
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content');

add_action('genesis_before_sidebar_widget_area', 'tw_add_member_sidebar');
function tw_add_member_sidebar(){
	wp_nav_menu( array( 'theme_location' => 'member-side', 'container_class' => 'member-sidebar') );
}
add_action( 'genesis_footer', 'member_custom_footer', 11 );
function member_custom_footer() {
	$output = '<div class="wrap"><p> &copy; Copyright ';
	$output .= date('Y');
	$output .= ' BurnBrighterLLC. All rights reserved.</p></div>';
	echo $output;
}

genesis();
