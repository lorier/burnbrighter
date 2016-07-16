<?php

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action('genesis_before_entry', 'genesis_post_info' );

add_filter( 'genesis_post_info', 'pb_single_post_info_filter', 0 );

function pb_single_post_info_filter($post_info) {
		$post_info = '<span>Posted on [post_date]' . get_the_category_list(' | ');
		return $post_info;
}

add_action( 'wp_head', 'tw_blog_page_setup' );

function tw_blog_page_setup() {

	if ( is_active_sidebar( 'blog-top-header' ) ) {

		// Add body class
		add_filter( 'body_class', 'tw_blog_body_class' );
		function tw_blog_body_class( $classes ) {
   			$classes[] = 'blog-page';

  			return $classes;
		}

		// Force full-width-content layout setting
		// add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Add homepage top area
		add_action( 'genesis_after_header', 'tw_blog_top' );

	}
}

// Setup homepage top area
function tw_blog_top() {
	
	if ( is_active_sidebar( 'blog-top-header' ) ) {
		genesis_widget_area( 'blog-top-header', array(
			'before' => '<div id="top-header" class="top-header widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	}
}

genesis();
