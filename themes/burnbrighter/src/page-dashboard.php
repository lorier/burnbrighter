<?php
/**
 * Template Name: Member Dashboard
 *
 * @author  Lorie Ransom
 * @license GPL-2.0+
 * @link    http://tinywhalecreative.com
 */
remove_action('genesis_sidebar', 'genesis_do_sidebar');

//remove all standard navigation
remove_action( 'genesis_header', 'tw_secondary_nav', 5 );
remove_action( 'genesis_header_right','genesis_do_nav' );
remove_action( 'genesis_footer', 'sp_custom_footer', 11 );
remove_action( 'genesis_footer', 'genesis_footer_widget_areas' );
remove_action ('genesis_footer','tw_footerwidgetheader_position',4);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

//add custom body class to these pages
add_filter( 'body_class', 'tw_body_class' );
function tw_body_class( $classes ) {
	
	$classes[] = 'member-dashboard';
	return $classes;
}
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content');

add_action('genesis_header_right', 'tw_add_member_topnav');
function tw_add_member_topnav(){
	wp_nav_menu( array( 'theme_location' => 'member-top', 'container_class' => 'genesis-nav-menu' ) );
}

add_action('genesis_before_sidebar_widget_area', 'tw_add_member_sidebar');
function tw_add_member_sidebar(){
	wp_nav_menu( array( 'theme_location' => 'member-side', 'container_class' => 'member-sidebar') );
}
genesis();
