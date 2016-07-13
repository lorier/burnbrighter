<?php

//sticky posts
//http://www.wpbeginner.com/wp-tutorials/how-to-display-the-latest-sticky-posts-in-wordpress/

function tw_latest_sticky() { 
	$return = '';
	/* Get all sticky posts */
	$sticky = get_option( 'sticky_posts' );

	/* Sort the stickies with the newest ones at the top */
	rsort( $sticky );

	/* Get the 5 newest stickies (change 5 for a different number) */
	$sticky = array_slice( $sticky, 0, 5 );

	/* Query sticky posts */
	$the_query = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );
	// The Loop
	if ( $the_query->have_posts() ) {
		$return .= '<ul>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$return .= '<li><a href="' .get_permalink(). '" title="'  . get_the_title() . '">' . get_the_title() . '</a><br />' . get_the_excerpt(). '</li>';
			
		}
		$return .= '</ul>';
		
	} else {
		// no posts found
		$return = 'Sorry no posts found';
	}
	/* Restore original Post Data */
	wp_reset_postdata();

	return $return; 

} 
add_shortcode('latest_stickies', 'tw_latest_sticky');