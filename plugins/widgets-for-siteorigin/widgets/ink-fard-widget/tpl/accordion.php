<?php
if( !empty($instance['title']) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];

$icon_styles = array();
$icon_styles[] = 'font-size: 2em';
if(!empty($instance['styling']['icon'])) $icon_styles[] = 'color: '.$instance['styling']['icon'];

if($instance['expand']):
	$expand = ' multi_expand: true;';
endif;

if($instance['toggleable']):
	$toggleable = ' toggleable: false;';
endif;

$acc_no = 1;

if( $instance['id'] ):
	$unique = $instance['id'];
else :
	$unique = 'fard-' . $instance['_sow_form_id'];
endif;
?>

<div class="iw-so-filter-acrdn-terms">
	<ul class="iw-so-acrdn-terms">
		<?php
		echo '<li><a class="filter" data-filter="all">' . $instance['all'] . '</a></li>';

		foreach ( $instance['filters'] as $term ) {
			echo '<li><a class="filter" data-filter=".' . $term['slug'] . '" >' . $term['name'] .'</a></li>';
		}
		?>
	</ul>
</div>

<ul class="accordion" id="Container" data-accordion data-options="<?php echo $expand . $toggleable; ?>">

	<?php foreach( $instance['toggles'] as $i => $toggle ) { ?>

		<li class="accordion-navigation mix <?php echo $toggle['slugs']; ?>">

			<a href="#<?php echo $unique . '-' . $acc_no; ?>" class="<?php echo $instance['styling']['text']; ?>">
				<?php echo $toggle['title']; ?>
				<span class="iw-so-tgl-open"><?php echo siteorigin_widget_get_icon( $instance['icon-open'], $icon_styles ); ?></span>
				<span class="iw-so-tgl-close"><?php echo siteorigin_widget_get_icon( $instance['icon-close'], $icon_styles ); ?></span>
			</a>

			<div id="<?php echo $unique . '-' . $acc_no; ?>" class="content<?php echo ($toggle['active'] == 1 ? ' active' : '' ); ?>">

				<?php echo $toggle['content']; ?>

			</div>

		</li>

		<?php $acc_no++; ?>

	<?php } ?>

</ul>
