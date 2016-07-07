<?php
if( !empty($instance['title']) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];

$icon_styles = array();
if(!empty($instance['icon']['color'])) $icon_styles[] = 'color: '.$instance['icon']['color'];

$tab_no = 1;
$cnt_no = 1;

if( $instance['id'] ):
	$unique = $instance['id'];
else :
	$unique = 'tab-' . $instance['_sow_form_id'];
endif;
?>

<ul class="tabs<?php echo ($instance['styling']['orientation'] == 'vertical' ? ' vertical' : ''); ?>" data-tab>

	<?php foreach( $instance['tabs'] as $i => $tab ) { ?>
        <li class="tab-title<?php echo ($tab['active'] == 1 ? ' active' : '' ); ?>"><a  href="#<?php echo $unique . '-' . $tab_no; ?>" href="#">
        	<?php echo siteorigin_widget_get_icon( $tab['icon'], $icon_styles ); ?>
            <?php echo $tab['title']; ?>
        </a></li>
        <?php $tab_no++; ?>
    <?php } ?>

</ul>
<div class="tabs-content<?php echo ($instance['styling']['orientation'] == 'vertical' ? ' vertical' : ''); ?>">

	<?php foreach( $instance['tabs'] as $i => $tab ) : ?>
        <div class="content<?php echo ($tab['active'] == 1 ? ' active' : '' ); ?>" id="<?php echo $unique . '-' . $cnt_no; ?>">
            <?php echo $tab['content']; ?>
        </div>
        <?php $cnt_no++; ?>
    <?php endforeach; ?>

</div>
