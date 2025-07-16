<table class="f12-table">
    <tr>
        <td class="label" style="width:300px;">
            <label><?php echo __("Bild ändern / hinzufügen","f12-slider");?></label>
        </td>
        <td>
            <input type="button" class="set_custom_images button" id="upload_image_button_slider"
                   value="<?php echo __("Bild hinzufügen","f12-slider");?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>
                <?php echo __("Vorschau","f12-slider");?>
            </label>
        </td>
        <td id="media-js">
            <!-- OUTPUT -->
			<?php
			if ( isset( $args["image"] ) && ! empty( $args["image"] ) ):
				?>
                <img src="<?php echo $args["image"]; ?>" style="max-width:100%;">
                <input type="hidden" name="image" class="f12-form-validate"
                       validation='{"condition":[{"name":"f12-gradient-color-1","value":"","type":"text"},{"name":"f12-gradient-color-2","value":"","type":"text"}],"validation":{"required":true}}'
                       value="<?php echo $args["image"]; ?>">
			<?php
			else:
				?>
                <input type="hidden" name="image" class="f12-form-validate"
                       validation='{"condition":[{"name":"f12-gradient-color-1","value":"","type":"text"},{"name":"f12-gradient-color-2","value":"","type":"text"}],"validation":{"required":true}}'
                       value="">
			<?php
			endif;
			?>
        </td>
    </tr>
    <tr>
        <th colspan="2">
            <?php echo __("Verlauf","f12-slider");?>
        </th>
    </tr>
    <tr>
        <td class="label" style="width:300px;">
            <label><?php echo __("Farbe 1","f12-slider");?></label>
        </td>
        <td>
            <input type="text" class="f12-color-picker f12-form-validate" validation='{"validation":{"required":true}}'
                   name="f12-gradient-color-1" value="<?php echo $args["f12-gradient-color-1"]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label" style="width:300px;">
            <label><?php echo __("Farbe 2","f12-slider");?></label>
        </td>
        <td>
            <input type="text" class="f12-color-picker f12-form-validate" validation='{"validation":{"required":true}}'
                   name="f12-gradient-color-2" value="<?php echo $args["f12-gradient-color-2"]; ?>"/>
        </td>
    </tr>
</table>