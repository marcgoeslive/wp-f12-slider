<?php echo $args["wp_nonce_field"]; ?>
<table class="f12-table">
    <tr>
        <td class="label" style="width:300px;">
            <label>Gruppe wählen</label>
        </td>
        <td>
            <select name="f12s-slider-group" class="f12-form-validate" validation='{"validation":{"required":true}}'><?php echo $args["f12s-slider-group"];?></select>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Kategorie wählen:</label>
        </td>
        <td>
            <input type="radio" name="type" value="a" <?php if($args["type"] == "a") echo "checked=\"checked\"";?>> Type A
            <input type="radio" name="type" value="b" <?php if($args["type"] == "b") echo "checked=\"checked\"";?>> Type B
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Position</label>
            <p>
                Die Position an der die Kachel dargestellt wird.
            </p>
        </td>
        <td>
            <input type="text" name="f12-sort"
                   value="<?php echo $args["f12-sort"]; ?>"/>
        </td>
    </tr>
</table>