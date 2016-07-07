<?php

add_image_size( 'folio', 600, 400, true );


add_filter( 'wpinked_byline', 'wpinked_so_post_byline_filter' );

function wpinked_so_post_byline_filter( $byline ) {

	$byline = str_replace( '%date%', '%1$s', $byline );
	$byline = str_replace( '%category%', '%2$s', $byline );
	$byline = str_replace( '%author%', '%3$s', $byline );
	$byline = str_replace( '%comments%', '%4$s', $byline );

	return $byline;
}

function wpinked_so_post_excerpt ( $limit, $after ) {

	if ( $limit ) :

		$excerpt = explode(' ', get_the_excerpt(), $limit);

		if ( count($excerpt) >= $limit):
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt). $after;
		else:
			$excerpt = implode(" ",$excerpt);
		endif;

	else :

		$excerpt = get_the_excerpt();

	endif;

	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

	echo $excerpt;

}

function wpinked_so_person_social ( $profiles, $align, $target ) {

	if ( $profiles ) { ?>

		<p class="iw-so-person-profiles <?php echo $align;?>">

			<?php
			$icon_styles = array();

			foreach( $profiles as $index => $profile ) { ?>

				<a href="<?php echo $profile['link']; ?>" target="<?php echo $target; ?>"><?php echo siteorigin_widget_get_icon( $profile['icon'], $icon_styles );?></a>

			<?php } ?>

		</p>

	<?php }
}

function wpinked_so_testimonial_name ( $name, $company, $link, $target, $align ) {

	if ( $name ) { ?>

		<h4 class="iw-so-testimonial-name <?php echo $align; ?>"><?php echo $name; ?></h4>

	<?php }

	if ( $company ) { ?>

		<h5 class="iw-so-testimonial-company <?php echo $align; ?>">

			<?php if ( $link ) : ?>
				<a target="<?php echo $target; ?>" href="<?php echo $link; ?>"><?php echo $company; ?></a>
			<?php else : ?>
				<?php echo $company; ?>
			<?php endif; ?>
		</h5>

	<?php }

}

function wpinked_so_blog_post_col($count, $cols) {
	if( $count % $cols == 0 ):
		echo 'iw-so-last-col';
	endif;
	if( $count % $cols == 1 ):
		echo 'iw-so-first-col';
	endif;
}
