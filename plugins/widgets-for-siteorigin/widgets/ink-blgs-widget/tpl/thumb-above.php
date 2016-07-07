<?php

$icon_styles = array();
if(!empty($instance['icons']['color'])) $icon_styles[] = 'color: '.$instance['icons']['color'];
if(!empty($instance['icons']['size'])) $icon_styles[] = 'font-size: '.$instance['icons']['size'];

$btn_class = array('iw-so-article-btn');
if( !empty($instance['styling']['btn-hover']) ) $btn_class[] = 'iw-so-article-btn-hover';
if( !empty($instance['styling']['btn-click']) ) $btn_class[] = 'iw-so-article-btn-click';

$navi_class = array('iw-so-navi-btn');
if( !empty($instance['pagination']['btn-hover']) ) $navi_class[] = 'iw-so-navi-btn-hover';
if( !empty($instance['pagination']['btn-click']) ) $navi_class[] = 'iw-so-navi-btn-click';

$navi_attributes = esc_attr(implode(' ', $navi_class));

$navi_previous = siteorigin_widget_get_icon( $instance['pagination']['newer-icon'] ) . ' ' . $instance['pagination']['newer-text'];
$navi_next = $instance['pagination']['older-text'] . ' ' . siteorigin_widget_get_icon( $instance['pagination']['older-icon'] );

if( $instance['design']['columns'] == 1 ):
	$cols = ' iw-small-12';
elseif( $instance['design']['columns'] == 2 ):
	$cols = ' iw-medium-6 iw-small-12';
elseif( $instance['design']['columns'] == 3 ):
	$cols = ' iw-large-4 iw-medium-6 iw-small-12';
elseif( $instance['design']['columns'] == 4 ):
	$cols = ' iw-large-3 iw-medium-6 iw-small-12';
endif;

if( !empty($instance['title']) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];

$h = $instance['design']['title-tag'];

$unique = $instance['_sow_form_id'];

$count = 1;
?>

<?php
// Setting up posts query
global $paged, $query_result;

$this_post = get_the_ID();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$post_selector_pseudo_query = $instance['posts'];
$processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );

if ( $instance['pagination']['activate'] ):
	$processed_query['paged'] = $paged;
endif;

if( $instance['current'] ):
	$processed_query['post__not_in'] = array($this_post);
endif;

$query_result = new WP_Query( $processed_query );
?>

<?php

// Looping through the posts

if($query_result->have_posts()) : ?>

	<div id="<? echo $unique; ?>">

		<div class="iw-row" data-equalizer>

			<?php while($query_result->have_posts()) : $query_result->the_post(); ?>

				<div class="iw-so-article<?php echo $cols; ?> iw-cols <?php wpinked_so_blog_post_col( $count, $instance['design']['columns'] ); ?>" data-equalizer-watch>

					<div class="iw-row iw-collapse iw-so-thumb-above">

						<div class="iw-small-12 iw-cols">

							<div class="iw-so-article-thumb">

								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail($instance['design']['img-size']); ?>
									<?php
									if ( get_post_format() && $instance['design']['format'] ):
										echo siteorigin_widget_get_icon( $instance['icons'][get_post_format()], $icon_styles );
									elseif ( $instance['design']['format'] ):
										echo siteorigin_widget_get_icon( $instance['icons']['standard'], $icon_styles );
									endif;
									?>
								</a>

							</div>

						</div>

						<div class="iw-small-12 iw-cols">

							<div class="iw-so-article-content">

								<?php if ($instance['design']['byline-above']) : ?>

									<?php $byline_above = apply_filters( 'wpinked_byline', $instance['design']['byline-above'] ); ?>

									<p class="iw-so-article-byline-above <?php echo $instance['styling']['align']; ?>">

										<?php echo sprintf( $byline_above, get_the_date(), get_the_category_list($instance['design']['cats']), '<a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a>', get_comments_number() ); ?>

									</p>

								<?php endif; ?>

								<<?php echo $h; ?> class="iw-so-article-title <?php echo $instance['styling']['align']; ?>"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></<?php echo $h; ?>>

								<?php if ($instance['design']['byline-below']) : ?>

									<?php $byline_below = apply_filters( 'wpinked_byline', $instance['design']['byline-below'] ); ?>

									<p class="iw-so-article-byline-below <?php echo $instance['styling']['align']; ?>">

										<?php echo sprintf( $byline_below, get_the_date(), get_the_category_list($instance['design']['cats']), '<a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a>', get_comments_number() ); ?>

									</p>

								<?php endif; ?>

								<?php if ( $instance['design']['content'] ): ?>

									<div class="iw-so-article-full">
										<?php global $more; $more = 1; the_content(); ?>
									</div>

								<?php elseif ( $instance['design']['excerpt'] ): ?>

									<p class="iw-so-article-excerpt <?php echo $instance['styling']['align']; ?>">
										<?php if ( $instance['design']['e-link'] ): ?>
											<a href="<?php the_permalink(); ?>">
												<?php wpinked_so_post_excerpt( $instance['design']['excerpt-length'], $instance['design']['excerpt-after'] ); ?>
											</a>
										<?php else: ?>
											<?php wpinked_so_post_excerpt( $instance['design']['excerpt-length'], $instance['design']['excerpt-after'] ); ?>
										<?php endif; ?>
									</p>

								<?php endif; ?>

								<?php if ($instance['design']['byline-end']) : ?>

									<?php $byline_end = apply_filters( 'wpinked_byline', $instance['design']['byline-end'] ); ?>

									<p class="iw-so-article-byline-end <?php echo $instance['styling']['align']; ?>">

										<?php echo sprintf( $byline_end, get_the_date(), get_the_category_list($instance['design']['cats']), '<a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a>', get_comments_number() ); ?>

									</p>

								<?php endif; ?>

								<?php if ($instance['design']['button']) : ?>

									<div class="iw-so-article-button">
										<a class="<?php echo esc_attr(implode(' ', $btn_class)); ?>" href="<?php the_permalink(); ?>">
											<?php echo $instance['design']['btn-text']; ?>
										</a>
									</div>

								<?php endif; ?>

							</div>

						</div>

					</div>

				</div>

			<?php endwhile; wp_reset_postdata(); ?>

		</div>

		<?php if ( $instance['pagination']['activate'] ): ?>

			<ul id='iw-so-blog-pagination' class="iw-so-blog-pagination">
				<li class="iw-so-blog-previous"><?php echo str_replace ( '<a', '<a class="' . $navi_attributes . '"', get_previous_posts_link( $navi_previous, $query_result->max_num_pages) ) ?></li>
				<li class="iw-so-blog-next"><?php echo str_replace ( '<a', '<a class="' . $navi_attributes . '"', get_next_posts_link( $navi_next, $query_result->max_num_pages) ) ?></li>
			</ul>

		<?php endif; ?>

	</div>

<?php endif; ?>

<?php if ( $instance['pagination']['activate'] && $instance['pagination']['type'] == 'ajax' ): ?>

	<script>
	jQuery(document).ready(function(){
		// AJAX pagination
		jQuery(function(jQuery) {
			jQuery('#<?php echo $unique; ?>').on('click', '#iw-so-blog-pagination a', function(e){
				e.preventDefault();
				var link = jQuery(this).attr('href');
				jQuery('#<?php echo $unique; ?>').fadeOut(500, function(){
					jQuery(this).load(link + ' #<?php echo $unique; ?>', function() {
						jQuery(this).fadeIn(500);
					});
				});
			});
		});
	});
	</script>

<?php endif; ?>
