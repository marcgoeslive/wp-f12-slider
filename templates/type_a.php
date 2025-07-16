<!-- ITEM BEGIN -->
<div class="bfi-slider__item bfi-slider--type_1 f12-js-slider__item">
	<div class="bfi-slider__image">
		<img src="<?php echo $args["image"]; ?>" alt="<?php echo $args["row_1"];?>">
	</div>
	<div class="bfi-slider__content">
		<p>
			<?php echo $args["row_1"]; ?>
		</p>
		<?php
		if ( isset( $args["row_2"] ) && ! empty( $args["row_2"] ) ) :
			?>
			<p><?php echo $args["row_2"]; ?></p>
		<?php
		endif;
		?>
	</div>
</div>
<!-- ITEM END -->