<table class="f12-table">
    <tr>
        <td class="label" style="width:300px;">
            <label>Zeile 1:</label>
        </td>
        <td>
            <input type="text" name="row_1"  class="f12-form-validate" validation='{"condition":[{"name":"type","value":"a","type":"checkbox"}],"validation":{"required":true}}'  value="<?php echo $args["row_1"];?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Zeile 2:</label>
        </td>
        <td>
            <input type="text" name="row_2" value="<?php echo $args["row_2"];?>"/>
        </td>
    </tr>
</table>