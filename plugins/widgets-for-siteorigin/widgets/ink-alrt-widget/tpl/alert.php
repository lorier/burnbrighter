<?php
    $icon_styles = array();
    if(!empty($instance['icon']['color'])) $icon_styles[] = 'color: '.$instance['icon']['color'];
?>
<div data-alert class="iw-so-alert">

	<?php if(!empty($instance['icon']['select'])) : ?>

		<?php echo siteorigin_widget_get_icon( $instance['icon']['select'], $icon_styles ); ?>

	<?php endif; ?>


	<div class="iw-so-alert-msg"><?php echo $instance['message']; ?></div>

	<?php if ($instance['close'] == 1 ) : ?><a href="#" class="close">&times;</a><?php endif; ?>

</div>