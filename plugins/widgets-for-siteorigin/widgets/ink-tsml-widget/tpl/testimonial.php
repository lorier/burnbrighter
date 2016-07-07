<?php 
if ( $instance['styling']['design'] == 'above' || $instance['styling']['design'] == 'below' ):
	$img_class = ' iw-small-12';
	$cnt_class = ' iw-small-12';
elseif ( $instance['styling']['design'] == 'left' ):
	$img_class = ' iw-small-12 iw-medium-3 iw-left';
	$cnt_class = ' iw-small-12 iw-medium-9 iw-right';
elseif ( $instance['styling']['design'] == 'right' ):
	$img_class = ' iw-small-12 iw-medium-3 iw-right';
	$cnt_class = ' iw-small-12 iw-medium-9 iw-left';
endif; 
?>

<div class="iw-row iw-so-testimonial">

	<?php if ( $instance['testimonial']['image'] && ($instance['styling']['design'] != 'below') ) : ?>

		<div class="iw-cols<?php echo $img_class; ?> iw-so-testimonial-img <?php echo $instance['styling']['design']; ?>">

			<?php echo wp_get_attachment_image( $instance['testimonial']['image'], 'full' ); ?>

	    </div>

	<?php endif; ?>

	<div class="iw-so-cols<?php echo $cnt_class; ?> ">

		<div class="iw-so-testimonial-content">

			<?php if ( $instance['testimonial']['content'] ) : ?>

				<p class="iw-so-testimonial-message <?php echo $instance['testimonial']['text']; ?>"><?php echo $instance['testimonial']['content']; ?></p>

			<?php endif; ?>

			<?php wpinked_so_testimonial_name ( $instance['name'], $instance['testimonial']['company'], $instance['testimonial']['link'], $instance['testimonial']['target'], $instance['styling']['text'] ); ?>

		</div>

	</div>

	<?php if ( $instance['testimonial']['image'] && ($instance['styling']['design'] == 'below') ) : ?>

		<div class="iw-cols<?php echo $img_class; ?> iw-so-testimonial-img <?php echo $instance['styling']['design']; ?>">

			<?php echo wp_get_attachment_image( $instance['testimonial']['image'], 'full' ); ?>

	    </div>

	<?php endif; ?>

</div>