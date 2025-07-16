<table class="f12-table">
    <tr>
        <td class="label" style="width:300px;">
            <label>Titel</label>
        </td>
        <td>
            <input type="text" class="f12-form-validate" name="title" validation='{"condition":[{"name":"type","value":"b","type":"checkbox"}],"validation":{"required":true}}'
                   value="<?php echo $args["title"]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Inhalt</label>
        </td>
        <td>
			<?php wp_editor( $args["content"], "content", array()); ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Darstellung</label>
        </td>
        <td>
            <input type="checkbox" name="is_quote"
                   value="1" <?php if ( $args["is_quote"] == 1 ) {
				echo "checked=\"checked\"";
			} ?>> <span>Ja, als Zitat darstellen</span>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Author</label>
        </td>
        <td>
            <input type="text" name="quote_author"
                   value="<?php echo $args["quote_author"]; ?>">
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Button Label</label>
        </td>
        <td>
            <input type="text" name="button_label" class="f12-form-validate" validation='{"condition":[{"name":"type","value":"b","type":"checkbox"}],"validation":{"required":true}}' value="<?php echo $args["button_label"]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Button Title</label>
        </td>
        <td>
            <input type="text" name="button_title" class="f12-form-validate" validation='{"condition":[{"name":"type","value":"b","type":"checkbox"}],"validation":{"required":true}}' value="<?php echo $args["button_title"]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Button Link</label>
        </td>
        <td>
            <select name="button_link" class="f12-form-validate" validation='{"condition":[{"name":"type","value":"b","type":"checkbox"}],"validation":{"required":true}}'>
				<?php echo $args["button_link"]; ?>
            </select>
        </td>
    </tr>
</table>