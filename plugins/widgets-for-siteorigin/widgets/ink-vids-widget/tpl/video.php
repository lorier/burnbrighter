<?php

$file = wp_get_attachment_url( $instance['video']['hosted'] );

$filetype = wp_check_filetype( $file );

if( !empty($instance['title']) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
?>

<div class="iw-so-video">

	<?php if ($instance['video']['type'] == 'oembed' ) : ?>

		<div class="video-flex-frame">
			<?php echo wp_oembed_get( $instance['video']['oembed'] ); ?>
		</div>

	<?php elseif ($instance['video']['type'] == 'hosted' ) : ?>

		<div class="iw-so-video-file  <?php echo $instance['video']['controls']; ?>">
			<?php echo do_shortcode('[video src="' . wp_get_attachment_url( $instance['video']['hosted'] ) . '" poster="' . wp_get_attachment_url( $instance['video']['image'] ) . '"]'); ?>
		</div>

	<?php endif; ?>

</div>