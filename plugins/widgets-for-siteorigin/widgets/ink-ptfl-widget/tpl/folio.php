<?php

$ink_post = $instance['design'];

if( !empty($instance['title']) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];

$icon_styles = array();
if(!empty($instance['styling']['icon'])) $icon_styles[] = 'color: '.$instance['styling']['icon'];
$icon_styles[] = 'font-size: 35px';

$project_class = ( $instance['design']['sorting'] ? 'mix' : 'no-mix' );
?>

<?php if ( $ink_post['sorting'] ): ?>

	<div class="iw-so-folio-terms-container">
		<ul class="iw-so-folio-terms">
			<?php 
			echo '<li><a class="filter" data-filter="all">' . __( 'ALL', 'wpinked-widgets' ) . '</a></li>';

			$taxonomy = 'jetpack-portfolio-type';
			$tax_terms = get_terms( $taxonomy );
	 
			foreach ( $tax_terms as $tax_term ) {
				echo '<li><a class="filter" data-filter=".' . $tax_term->slug . '" >' . $tax_term->name .'</a></li>';
			}
			?>
		</ul>
	</div>

<?php endif; ?>

<?php
// Setting up posts query

$post_selector_pseudo_query = $instance['portfolio'];

$processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );

$query_result = new WP_Query( $processed_query );
?>

<?php
// Looping through the posts

if($query_result->have_posts()) : ?>

	<div  id="folio-grid" class="iw-so-folio-grid iw-row iw-collapse"  data-equalizer>

		<?php while($query_result->have_posts()) : $query_result->the_post(); ?>

				<?php 
				// get Jetpack Portfolio taxonomy terms for portfolio filtering
				$terms = get_the_terms( $post->ID, 'jetpack-portfolio-type' );
										
				if ( $terms && ! is_wp_error( $terms ) ) : 
				 
					$filtering_links = array();
				 
					foreach ( $terms as $term ) {
						$filtering_links[] = $term->slug;
					}
										
					$filtering = join( ", ", $filtering_links );

					$types = join( " ", $filtering_links );
				?>
				 
				<div class="<?php echo $project_class; ?> <?php echo $types; ?> iw-cols">
					<article class="iw-so-project-article"  data-equalizer-watch>

						<?php  if ( '' != get_the_post_thumbnail() ) : ?>
							<div class="iw-so-project-image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'folio' ); ?>	
									<?php echo siteorigin_widget_get_icon( $instance['design']['icon'], $icon_styles ); ?>							
								</a>								
							</div>
						<?php endif; ?>
						<h3 class="iw-so-project-title iw-text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="iw-so-project-type iw-text-center"><?php echo $filtering; ?></p>
						
					</article>				    
				</div>
				 
				<?php
				endif; ?>

		<?php endwhile; wp_reset_postdata(); ?>

	</div>

<?php endif; ?>