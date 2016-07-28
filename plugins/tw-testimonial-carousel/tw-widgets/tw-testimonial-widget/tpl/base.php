<?php
$query = siteorigin_widget_post_selector_process_query( $instance['posts'] );
$posts = new WP_Query( $query );
?>

<?php if($posts->have_posts()) : ?>

	<a href="#" class="tw-carousel-nav left">
		<span href="#" class="tw-carousel-previous" title="<?php esc_attr_e('Previous', 'so-widgets-bundle') ?>"></span>
	</a>

	<div class="tw-carousel-container<?php if( is_rtl() ) echo ' js-rtl' ?>">

		<div class="tw-carousel-wrapper"
		     data-query="<?php echo esc_attr($instance['posts']) ?>"
		     data-found-posts="<?php echo esc_attr($posts->found_posts) ?>"
		     data-ajax-url="<?php echo sow_esc_url( wp_nonce_url( admin_url('admin-ajax.php'), 'widgets_action', '_widgets_nonce' ) ) ?>"
			>
			<ul class="tw-carousel-items">

				<?php 
				include plugin_dir_path( __FILE__ ) . 'carousel-post-loop.php' ?>
			</ul>
		</div>
	</div>
	<a href="#" class="tw-carousel-nav right">
		<span href="#" class="tw-carousel-next" title="<?php esc_attr_e('Next', 'so-widgets-bundle') ?>"></span>
	</a>
<?php endif; ?>