<?php

add_action( 'genesis_setup', 'pb_load_includes', 15 );
function pb_load_includes() {
    foreach ( glob( dirname( __FILE__ ) . '/custom_inc/*.php' ) as $file ) { include $file; }
}

// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Set Localization (do not remove)
load_child_theme_textdomain( 'lean-kickstart', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'lean-kickstart' ) );


// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Burn Brighter' );
define( 'CHILD_THEME_URL', 'https://burnbrighter.com' );
define( 'CHILD_THEME_VERSION', '0.0.1' );



add_action( 'wp_enqueue_scripts', 'kickstart_fonts_scripts' );
// Enqueue fonts
function kickstart_fonts_scripts() {
	wp_enqueue_style( 'smitten-font', get_stylesheet_directory_uri() . '/webfonts/Smitten-Regular.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0' );
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'google-font-raleway', '//fonts.googleapis.com/css?family=Raleway:400,600,700', array(), CHILD_THEME_VERSION );
	
}


add_action( 'wp_enqueue_scripts', 'tw_enqueue_stickynav_script' );
function tw_enqueue_stickynav_script() {
	wp_enqueue_script( 'sample-sticky-menu', get_stylesheet_directory_uri() . '/js/stickynav.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'core', get_stylesheet_directory_uri() . '/js/core.js', array( 'jquery' ), '1.0.0' );
	//provided with the Smitten Font
	wp_enqueue_script( 'fontsmoothie', get_stylesheet_directory_uri() . '/js/fontsmoothie.js');
	wp_enqueue_script( 'kickstart-responsive-menu', get_stylesheet_directory_uri() . '/js/responsivemenu.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	$output = array(
		'mainMenu' => __( 'Menu', 'no-sidebar' ),
		'subMenu'  => __( 'Menu', 'no-sidebar' ),
	);
	wp_localize_script( 'kickstart-responsive-menu', 'KickstartL10n', $output );
}

add_action( 'wp_enqueue_scripts', 'kickstart_enqueue_backstretch_scripts' );
// Enqueue Backstretch script and prepare images for loading
function kickstart_enqueue_backstretch_scripts() {

	// Load scripts only if custom background or featured image is being used

	// If we're on a page with no featured image or background image, leave
	if ( is_page() && ! has_post_thumbnail() && ! get_background_image() ) {
		return;
	}

	// If we're not on a page and there's no background image, leave
	if ( ! is_page() && ! get_background_image() ) {
		return;
	}

	wp_enqueue_script( 'kickstart-backstretch', get_stylesheet_directory_uri() . '/js/backstretch.js', array( 'jquery' ), '2.0.4' );
	wp_enqueue_script( 'kickstart-backstretch-set', get_stylesheet_directory_uri() . '/js/backstretch-set.js' , array( 'kickstart-backstretch' ), CHILD_THEME_VERSION );

	wp_localize_script( 'kickstart-backstretch-set', 'KickstartBackStretchImg', array( 'src' => str_replace( 'http:', '', get_background_image() ) ) );

	if ( is_home() ) {
		wp_localize_script( 'kickstart-backstretch-set', 'KickstartBackStretchImg', array( 'src' => str_replace( 'http:', '', get_background_image() ) ) );
	}
	else if ( has_post_thumbnail() ) {
		$image = array( 'src' => has_post_thumbnail() ? genesis_get_image( array( 'format' => 'url' ) ) : '' );
		wp_localize_script( 'kickstart-backstretch-set', 'KickstartBackStretchImg', $image );
	}
	else {
		wp_localize_script( 'milton-backstretch-set', 'KickstartBackStretchImg', array( 'src' => str_replace( 'http:', '', get_background_image() ) ) );
	}

}

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Move menu to Header Right and remove the wrap div
remove_action( 'genesis_after_header','genesis_do_nav' ) ;
add_action( 'genesis_header_right','genesis_do_nav' );
add_theme_support( 'genesis-footer-widgets', 1 );
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets' ) );

// Unregister alternate layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Add custom background callback for background color
function kickstart_background_callback() {
    if ( ! get_background_color() ) {
        return;
    }
    printf( '<style>body { background-color: #%s; }</style>' . "\n", get_background_color() );
}

// Allow shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'the_content_more_link', 'kickstart_read_more_link' );
// Modify the WordPress read more link
function kickstart_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'lean-kickstart' ) . '</a>';
}

// Unregister sidebars
unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar-alt' );

// Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home Top', 'lean-kickstart' ),
	'description' => __( 'This is the top section of the homepage.', 'lean-kickstart' ),
) );


// Add the 'before footer' widget area (before the erm, footer)
add_action ( 'genesis_before_footer', 'kickstart_before_footer', 5 );
function kickstart_before_footer() {
	genesis_widget_area( 'before-footer', array(
		'before' => '<section class="before-footer"><div class="wrap">',
		'after'  => '</div></section>',
	) );
}
add_action ( 'genesis_before_footer', 'kickstart_footer_social', 15 );
// Add the 'footer social' widget area
function kickstart_footer_social() {
	genesis_widget_area( 'footer-social', array(
		'before' => '<section class="footer-social"><div class="wrap">',
		'after'  => '</div></section>',
	) );
}

add_filter( 'genesis_search_text', 'kickstart_search_text' );
// Customize search form input box text
function kickstart_search_text( $text ) {
	$search_text = __( 'Search', 'lean-kickstart' );

	return $search_text;
}

add_filter( 'genesis_search_button_text', 'kickstart_search_button_text' );
// Customize search form input button text
function kickstart_search_button_text( $text ) {
	$searchbutton_text = __( 'Go', 'lean-kickstart' );

	return $searchbutton_text;
}

add_action( 'genesis_after_entry', 'kickstart_single_next_prev', 5 );
// Next / previous post links
function kickstart_single_next_prev() {
	// Only show on single pages
	if( !is_single() ) {
		return;
	}

	$previouspost_text =  __( 'Previous Post', 'lean-kickstart' );
	$nextpost_text     =  __( 'Next Post', 'lean-kickstart' );

	echo '<div class="archive-pagination pagination">';
		previous_post_link( '<div class="pagination-previous alignleft">%link</div>', $previouspost_text );
		next_post_link( '<div class="pagination-next alignright">%link</div>', $nextpost_text );
	echo '</div>';
}


//Include BB-specific Function files
add_action('wp_head', 'tw_favicons' );
function tw_favicons(){
	$blog_url = esc_url( get_stylesheet_directory_uri() ); 
	echo 
<<<EOT
	<link rel="apple-touch-icon" sizes="180x180" href="$blog_url/images/apple-touch-icon.png">
<link rel="icon" type="image/png" href="$blog_url/images/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="$blog_url/images/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="$blog_url/images/manifest.json">
<link rel="mask-icon" href="$blog_url/images/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
EOT;
}
