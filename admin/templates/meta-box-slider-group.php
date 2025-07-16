<a href="post-new.php?post_type=f12s_slider&f12s-slider-group-id=<?php echo $args["f12s-slider-group-id"]; ?>"
   class="button">Slider erstellen</a>
<br><br>
<table class="wp-list-table widefat fixed striped posts">
    <thead>
    <tr>
        <th style="width:130px;">
            Bild
        </th>
        <th scope="scole">
            Slider
        </th>
    </tr>
    </thead>
    <tbody class="f12-sortable">
	<?php
	if ( isset( $args["f12s-slider-group"] ) ):
		foreach ( $args["f12s-slider-group"] as $key => $value ) :
			?>
            <tr id="<?php echo $value[0];?>">
                <td>
                    <img src="<?php echo $value[2]; ?>" style="max-height:50px; max-width:100%;"/>
                </td>
                <td>
                    <a
                            href="post.php?post=<?php echo $value[0]; ?>&amp;action=edit"
                            aria-label="„<?php echo $value[1]; ?>“ bearbeiten"><?php echo $value[1]; ?></a>
                    <div class="row-actions">
                        <span class="edit"><a
                                    href="post.php?post=<?php echo $value[0]; ?>&amp;action=edit"
                                    aria-label="„<?php echo $value[1]; ?>“ bearbeiten">Bearbeiten</a> | </span>
                        <span class="trash"><a
                                    href="<?php echo get_delete_post_link( $value[0] ); ?>&f12s-slider-group-id=<?php echo $args["f12s-slider-group-id"]; ?>"
                                    class="submitdelete"
                                    aria-label="„<?php echo $value[1]; ?>“ in den Papierkorb verschieben">In Papierkorb legen</a> | </span>
                    </div>
                </td>
            </tr>
		<?php
		endforeach;
	endif;
	?>
    </tbody>
</table>