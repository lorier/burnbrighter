<?php
$posts = new WP_Query($query);
while($posts->have_posts()) : $posts->the_post(); ?>
	<li class="tw-carousel-item<?php if( is_rtl() ) echo ' rtl' ?>">
		<div class="tw-content"><?php the_content(); ?></div>
		<div class="tw-client-info-wrapper">
			<div class="tw-carousel-thumbnail">
				<?php if( has_post_thumbnail() ) : $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'tw-carousel-default'); ?>
					<div class="headshot" style="background-image: url(<?php echo sow_esc_url($img[0]) ?>)">
						<span class="overlay"></span>
					</div>
				<?php else : ?>
					<div class="tw-carousel-default-thumbnail"><span class="overlay"></span></div>
				<?php endif; ?>
			</div>
			<div class="tw-client-info">
				<h3><?php the_title() ?></h3>
				<p><?php the_field('client_information') ?></p>
			</div>
		</div>
	</li>
<?php endwhile; wp_reset_postdata(); ?>