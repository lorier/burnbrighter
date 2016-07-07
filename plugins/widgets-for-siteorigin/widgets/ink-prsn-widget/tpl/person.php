<div class="iw-row iw-so-person">

	<div class="iw-cols iw-small-12 iw-so-person-img">		

		<div class="iw-row">

			<?php echo wp_get_attachment_image( $instance['person']['image'], 'full' ); ?>

			<div class="iw-so-person-ol">
				
				<?php if( $instance['styling']['design'] == 'about' ) : ?>

					<p class="iw-so-person-about <?php echo $instance['styling']['align'];?>"><?php echo $instance['person']['about']; ?></p>

				<?php endif; ?>

				<?php if( $instance['styling']['design'] == 'icons' ) : ?>

					<?php wpinked_so_person_social( $instance['social']['profiles'], $instance['styling']['align'], $instance['social']['target'] ); ?>

				<?php endif; ?>

			</div>
		</div>

	</div>

	<div class="iw-cols iw-small-12 iw-so-person-content">

		<h4 class="iw-so-person-name <?php echo $instance['styling']['align'];?>"><?php echo $instance['name']; ?></h4>

		<p class="iw-so-person-desig <?php echo $instance['styling']['align'];?>"><?php echo $instance['person']['designation']; ?></p>

		<?php if( $instance['styling']['design'] != 'about' ) : ?>

			<p class="iw-so-person-about <?php echo $instance['styling']['align'];?>"><?php echo $instance['person']['about']; ?></p>

		<?php endif; ?>

		<?php if( $instance['styling']['design'] != 'icons' ) : ?>

			<?php wpinked_so_person_social( $instance['social']['profiles'], $instance['styling']['align'] ); ?>

		<?php endif; ?>

	</div>

</div>