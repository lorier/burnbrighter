<?php 
$number_attributes = array('data-refresh-interval' => '50' );
if(!empty($instance['number']['start'])) $number_attributes['data-from'] = esc_attr($instance['number']['start']);
if(!empty($instance['number']['end'])) $number_attributes['data-to'] = esc_attr($instance['number']['end']);
if(!empty($instance['number']['speed'])) $number_attributes['data-speed'] = esc_attr($instance['number']['speed']);
?>

<div class="iw-so-number">

	<?php if ($instance['number']['title'] && $instance['number']['title-pos'] == 'above') : ?>
		<h3 class="iw-so-number-title iw-text-center"><?php echo $instance['number']['title']; ?></h3>
	<?php endif; ?>

	<p class="iw-so-number-count iw-text-center">
		<?php echo $instance['number']['prefix']; ?><span class="iw-so-number-timer" <?php foreach($number_attributes as $name => $val) echo $name . '="' . $val . '" ' ?>></span><?php echo $instance['number']['suffix']; ?>
	</p>

	<?php if ($instance['number']['title'] && $instance['number']['title-pos'] == 'below') : ?>
		<h3 class="iw-so-number-title iw-text-center"><?php echo $instance['number']['title']; ?></h3>
	<?php endif; ?>

</div>