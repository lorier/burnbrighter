<?php


// Add a Header widget above the others
add_action ('widgets_init','tw_footerwidgetheader');
function tw_footerwidgetheader() {
	genesis_register_sidebar( array(
	'id' => 'footerwidgetheader',
	'name' => __( 'Footer Widget Header', 'genesis' ),
	'description' => __( 'This is for the Footer Widget Headline', 'genesis' ),
	) );
}

//Position Widget Header
add_action ('genesis_footer','tw_footerwidgetheader_position',4);
function tw_footerwidgetheader_position ()  {
	echo '<div class="footer-widget-header-container"><div class="wrap">';
	genesis_widget_area ('footerwidgetheader');
	echo '</div></div>';
}

genesis_register_sidebar( array(
	'id'          => 'home-top-header',
	'name'        => __( 'Home Top (Headline)', 'lean-kickstart' ),
	'description' => __( 'Add a headline graphic.', 'lean-kickstart' ),
) );

genesis_register_sidebar( array(
	'id'          => 'blog-top-header',
	'name'        => __( 'Blog Top (Headline)', 'lean-kickstart' ),
	'description' => __( 'Add a headline graphic.', 'lean-kickstart' ),
) );

genesis_register_sidebar( array(
	'id'          => 'philosophy-top-header',
	'name'        => __( 'Philosophy Top (Headline)', 'lean-kickstart' ),
	'description' => __( 'Add a headline graphic.', 'lean-kickstart' ),
) );
genesis_register_sidebar( array(
	'id'          => 'program-top-header',
	'name'        => __( 'Program Top (Headline)', 'lean-kickstart' ),
	'description' => __( 'Add a headline graphic.', 'lean-kickstart' ),
) );


//Philosophy Header
add_action( 'wp_head', 'tw_philosophy_top_header' );

function tw_philosophy_top_header() {

	if ( is_page(3) && is_active_sidebar( 'philosophy-top-header' ) ) {

		// Add body class
		add_filter( 'body_class', 'tw_philosophy_body_class' );
		function tw_philosophy_body_class( $classes ) {
   			$classes[] = 'philosophy-page';

  			return $classes;
		}
		// Add homepage top area
		add_action( 'genesis_after_header', 'tw_philosophy_top' );

	}
}
// Setup philosophy top area
function tw_philosophy_top() {
	
	if ( is_active_sidebar( 'philosophy-top-header' ) ) {
		genesis_widget_area( 'philosophy-top-header', array(
			'before' => '<div id="top-header" class="top-header widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	}
}

//Program Header
add_action( 'wp_head', 'tw_program_top_header' );

function tw_program_top_header() {

	if ( is_page(4) && is_active_sidebar( 'program-top-header' ) ) {

		// Add body class
		add_filter( 'body_class', 'tw_program_body_class' );
		function tw_program_body_class( $classes ) {
   			$classes[] = 'program-page';

  			return $classes;
		}
		// Add homepage top area
		add_action( 'genesis_after_header', 'tw_program_top' );

	}
}
// Setup homepage top area
function tw_program_top() {
	
	if ( is_active_sidebar( 'program-top-header' ) ) {
		genesis_widget_area( 'program-top-header', array(
			'before' => '<div id="top-header" class="top-header widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	}
}

//Set up blog and single
add_action( 'wp_head', 'tw_blog_page_setup' );

function tw_blog_page_setup() {

	if ( !is_page() && !is_404() && is_active_sidebar( 'blog-top-header' ) ) {

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