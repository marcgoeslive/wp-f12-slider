<!-- ITEM BEGIN -->
<div class="f12-image-teaser f12-slider--type_2 f12-image-teaser--special  f12-js-slider__item">
    <div class="f12-image-teaser__box">
        <img src="<?php echo $args["image"]; ?>" alt="<?php echo $args["title"]; ?>"
             data-url-default="<?php echo $args["image"]; ?>"
             data-url-responsive="<?php echo $args["image_responsive_src"]; ?>">
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