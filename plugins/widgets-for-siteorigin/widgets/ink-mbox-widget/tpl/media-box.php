<?php

$icon_styles = array();
if(!empty($instance['styling']['icon-size'])) $icon_styles[] = 'font-size: '.$instance['styling']['icon-size'];
if(!empty($instance['styling']['icon-clr'])) $icon_styles[] = 'color: '.$instance['styling']['icon-clr'];

$classes = array('iw-so-imgbox-btn');
if( !empty($instance['styling']['btn-hover']) ) $classes[] = 'iw-so-imgbox-btn-hover';
if( !empty($instance['styling']['btn-click']) ) $classes[] = 'iw-so-imgbox-btn-click';

$button_attributes = array(
	'class' => esc_attr(implode(' ', $classes))
);
if(!empty($instance['box']['btn-window'])) $button_attributes['target'] = '_blank';
if(!empty($instance['box']['btn-url'])) $button_attributes['href'] = sow_esc_url($instance['box']['btn-url']);
if(!empty($instance['box']['btn-id'])) $button_attributes['id'] = esc_attr($instance['box']['btn-id']);
if(!empty($instance['box']['btn-title'])) $button_attributes['title'] = esc_attr($instance['box']['btn-title']);
if(!empty($instance['box']['btn-onclick'])) $button_attributes['onclick'] = esc_attr($instance['box']['btn-onclick']);
?>

<div class="iw-row iw-collapse iw-so-imgbox">
	<div class="iw-small-12 iw-cols">
		<?php if ( $instance['box']['media'] == 'image' ): ?>
			<center><?php echo wp_get_attachment_image( $instance['box']['image'], 'full' ); ?></center>
		<?php elseif ( $instance['box']['media'] == 'icon' ): ?>
			<center><?php echo siteorigin_widget_get_icon( $instance['box']['icon'], $icon_styles ); ?></center>
		<?php endif; ?>
	</div>
	<div class="iw-small-12 iw-cols">
		<?php if ( $instance['box']['title'] ): ?>
			<h3 class="iw-so-imgbox-title iw-text-center"><?php echo $instance['box']['title']; ?></h3>
		<?php endif; ?>
		<?php if ( $instance['box']['content'] ): ?>
			<p class="iw-so-imgbox-content iw-text-center"><?php echo $instance['box']['content']; ?></p>
		<?php endif; ?>
	</div>
	<div class="iw-small-12 iw-cols">
		<?php if ( $instance['box']['btn'] ): ?>
			<div class="iw-so-imgbox-btn-base iw-text-center">
				<a <?php foreach($button_attributes as $name => $val) echo $name . '="' . $val . '" ' ?>>
					<?php echo $instance['box']['btn']; ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>