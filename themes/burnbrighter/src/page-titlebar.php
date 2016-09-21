<?php
/**
 * Template Name: Title Bar
 *
 * @author  Lorie Ransom
 * @license GPL-2.0+
 * @link    http://tinywhalecreative.com
 */
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');
add_action( 'genesis_after_header', 'tw_standard_header_before' );


function tw_standard_header_before(){
	echo '<div class="default-header">';
	echo '<h1>'.get_the_title( ).'</h1>';
	echo '</div>';
}

genesis();
