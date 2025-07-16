<!-- ITEM BEGIN -->
<div class="f12-image-teaser f12-slider--type_2 f12-image-teaser--special  f12-js-slider__item">
    <div class="f12-image-teaser__box">
        <div class="f12-slider__gradient" style="background-image:radial-gradient(circle at 47% 9%, <?php echo $args["f12-gradient-color-2"];?>,<?php echo $args["f12-gradient-color-1"];?>);"></div>
        <div class="f12-slider__fade"></div>
    </div>
    <div class="f12-image-teaser__content">
        <h1>
            <span>
			<?php echo $args["title"]; ?>
                </span>
        </h1>
        <p>
			<?php echo $args["content"]; ?>
			<?php if ( $args["is_quote"] == true ) : ?>
                <small><?php echo $args["author"]; ?></small>
			<?php endif; ?>
        </p>
        <p>
            <a href="<?php echo get_permalink( $args["button_link"] ); ?>" title="<?php echo $args["button_title"]; ?>"
               class="f12-button">
				<?php echo $args["button_label"]; ?>
            </a>
        </p>
    </div>
</div>
<!-- ITEM END -->