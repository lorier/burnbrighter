<?php

$icon_styles = array();
$icon_styles[] = 'font-size: 2em';
if(!empty($instance['styling']['icon'])) $icon_styles[] = 'color: '.$instance['styling']['icon'];

if($instance['settings']['expand']):
	$expand = ' multi_expand: true;';
endif;

if($instance['settings']['toggleable']):
	$toggleable = ' toggleable: false;';
endif;

$acc_no = 1;

if( $instance['settings']['id'] ):
	$unique = $instance['settings']['id'];
else :
	$unique = 'ardn-' . $instance['_sow_form_id'];
endif;
?>

<ul class="accordion" data-accordion data-options="<?php echo $expand . $toggleable; ?>">

	<?php foreach( $instance['toggles'] as $i => $toggle ) { ?>

		<li class="accordion-navigation">

			<a href="#<?php echo $unique . '-' . $acc_no; ?>" class="<?php echo $instance['styling']['text']; ?>">
				<?php echo $toggle['title']; ?>
				<span class="iw-so-tgl-open"><?php echo siteorigin_widget_get_icon( $instance['settings']['icon-open'], $icon_styles ); ?></span>
				<span class="iw-so-tgl-close"><?php echo siteorigin_widget_get_icon( $instance['settings']['icon-close'], $icon_styles ); ?></span>
			</a>

			<div id="<?php echo $unique . '-' . $acc_no; ?>" class="content<?php echo ($toggle['active'] == 1 ? ' active' : '' ); ?>">

				<?php echo $toggle['content']; ?>

			</div>

		</li>

		<?php $acc_no++; ?>

	<?php } ?>

</ul>
