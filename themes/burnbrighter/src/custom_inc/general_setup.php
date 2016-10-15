<?php
//remove tites from pages

// Image sizes
add_action( 'after_setup_theme', 'tw_feature_image_crop' );
function tw_feature_image_crop() {
	add_image_size( 'homepage_sticky', 308, 400, true );
}

// Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'tw_secondary_nav', 5 );
function tw_secondary_nav(){
	echo '<div id="nav-secondary-wrap" class="mobile-hidden wrap ">';
	genesis_do_subnav();
	echo '</div>';
}

//Reoposition and format post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action('genesis_entry_header', 'genesis_post_info', 9 );

add_filter( 'genesis_post_info', 'pb_single_post_info_filter', 0 );

function pb_single_post_info_filter($post_info) {
		$post_info = '<span>Posted on [post_date]'.'&nbsp;&nbsp;|&nbsp;&nbsp;' . get_the_category_list(' | ');
		return $post_info;
}

//Add member side menu
add_action( 'init', 'tw_register_member_side_menu' );
function tw_register_member_side_menu() {
	register_nav_menu( 'member-side' ,__( 'Member Dashboard Side Navigation Menu' ));
}

//Add Legal Menu
add_action( 'init', 'tw_register_legal_menu' );
function tw_register_legal_menu() {
	register_nav_menu( 'legal' ,__( 'Legal Documents Menu' ));
}

add_action( 'wp_head', 'tw_blog_page_setup' );
//add featured image to posts
add_action( 'genesis_entry_content', 'pb_featured_post_image', 8 );
function pb_featured_post_image() {
  if ( ! is_singular( array('post') ) )  return;
	the_post_thumbnail('post-image');
}

// Customize the legal text
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer', 11 );
function sp_custom_footer() {
	$output = '<div class="wrap copyright"><p> &copy; Copyright ';
	$output .= date('Y');
	$output .= ' BurnBrighterLLC. All rights reserved.</p></div>';
	echo $output;
}
//Add legal links to footer
add_action( 'genesis_footer', 'pb_footer_menu', 12 );
function pb_footer_menu() {

	genesis_nav_menu( array(
		'theme_location' => 'legal',
		'container'       => 'div',
		'container_class' => 'wrap',
		'menu_class'     => 'legal-menu',
		'depth'           => 1
	) );

}

remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas' );

// Enable shortcode use in widgets
add_filter('widget_text', 'do_shortcode');

// Add "now viewing" to tag pages 
add_action('genesis_before_loop', 'tw_add_tag_title');

function tw_add_tag_title(){
	if (is_tag()){
		echo '<p class="tag-title">Viewing items tagged:</p>';
	}
}
// Change pagination button text 
add_filter( 'genesis_prev_link_text', 'tw_review_prev_link_text' );
function tw_review_prev_link_text() {
        $prevlink = 'Newer Posts';
        return $prevlink;
}
add_filter( 'genesis_next_link_text', 'tw_review_next_link_text' );
function tw_review_next_link_text() {
        $nextlink = 'Older Posts';
        return $nextlink;
}

// Change post meta text
add_filter( 'genesis_post_meta', 'tw_post_meta_filter' );
function tw_post_meta_filter($post_meta) {
if ( !is_page() ) {
	$post_meta = '[post_tags before="Tagged: "] [post_comments] [post_edit]';
	return $post_meta;
}}

add_filter('get_the_archive_title', 'tw_add_tag_leader_text');
function tw_add_tag_leader_text($title){
	echo 'filter called';
	$prefix = '';
	if ( is_tag() ) {
		// $prefix = '<p>Viewing posts tagged:</p>';
		$title = single_tag_title( '<p>Viewing posts tagged:</p>', false );
	}
	return $title;
}
// remove genesis favicon
remove_action('genesis_meta', 'genesis_load_favicon');

add_filter( 'genesis_pre_load_favicon', 'tw_favicon_filter' );
function tw_favicon_filter( $favicon_url ) {
	$base = get_stylesheet_directory_uri();
	return  esc_url($base) . 'images/favicon.ico';
}
//Force home page layout to full width
add_action( 'wp', 'tw_force_home_page_layout' );
function tw_force_home_page_layout() {
    if ( is_front_page() ) {
		add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');
    }
}


// add_action( 'genesis_before', 'pb_move_featured_image' );
function pb_move_featured_image(){
	if( is_front_page()){
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8);
		add_action('genesis_entry_header', 'genesis_do_post_image', 1);
	}
}
// Remove title from all pages
add_action( 'get_header', 'tw_remove_post_titles' );
function tw_remove_post_titles() {
	if(is_page()){
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	}
}
add_action( 'genesis_after_header', 'tw_404_header' );
function tw_404_header(){
	if(is_404()){
		echo "<div class='error-header'><h1>404</h1></div>";
	}
}