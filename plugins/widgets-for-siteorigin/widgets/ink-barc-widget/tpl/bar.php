<?php foreach( $instance['bars'] as $i => $bar ) { ?>

	<div class="iw-so-bar">
		<h6 class="iw-so-bar-title"><?php echo $bar['title']; ?></h6>
		<?php if ($instance['styling']['percent-show']) : ?>
			<span class="iw-so-bar-percent"><?php echo $bar['percent']; ?>%</span>
		<?php endif; ?>
		<div class="iw-so-bar-container">
			<span class="iw-so-bar-meter" aria-valuenow="<?php echo $bar['percent']; ?>"></span>
		</div>
	</div>

<?php } ?>