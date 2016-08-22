<?php

//sticky posts
//http://www.wpbeginner.com/wp-tutorials/how-to-display-the-latest-sticky-posts-in-wordpress/

function tw_latest_sticky() { 
	$output = '';
	/* Get all sticky posts */
	$sticky = get_option( 'sticky_posts' );

	/* Sort the stickies with the newest ones at the top */
	rsort( $sticky );

	/* Get the 5 newest stickies */
	$sticky = array_slice( $sticky, 0, 3 );

	/* Query sticky posts */
	$the_query = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );
	// The Loop
	if ( $the_query->have_posts() ) {
		$output .= '<div class="sticky-wrapper">';

		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			global $post;
			$thecat = tw_get_the_category(get_the_ID());
			$output .= '<a href="' .get_permalink(). '" title="'  . get_the_title() . '">';
			
			$output .= '<div class="sticky-panel-wrapper"><div class="sticky-panel">';
				$output .= '<div class="sticky-image">';
				$output .= get_the_post_thumbnail();
				$output .= '<p class="sticky-category '.$thecat->slug.'">'.$thecat->name.'</p>';
				$output .= '</div>';
				$output .= '<div class="sticky-title">';
				$output .=  '<h3>' . get_the_title() . '</h3>';
				$output .= '</div>';
			$output .= '</div></div>';
			
			$output .= '</a>';
			
		}
		$output .= '</div>';
		
	} else {
		// no posts found
		$output = 'Sorry no posts found';
	}
	/* Restore original Post Data */
	wp_reset_postdata();

	return $output; 

} 
add_shortcode('latest_stickies', 'tw_latest_sticky');

function tw_get_the_category($id = 0){
	$catId = get_the_category($id);
	$thecat = reset($catId);
	return $thecat;
}