<div class="meta-page f12-page-settings">
    <h1>Slider Einstellungen</h1>

    <form action="<?php echo esc_url( admin_url( "admin-post.php" ) ); ?>" method="post"
          name="f12s_slider_settings" id="f12s_slider_settings">
        <input type="hidden" name="action" value="f12s_slider_settings_save">
        <div class="f12-panel">
            <div class="f12-panel__header">
                <h2>Darstellung</h2>
                <p>
                    Darstellungsoptionen für den Slider.
                </p>
            </div>
            <div class="f12-panel__content">
                <table class="f12-table">
                    <tr>
                        <td class="label" style="width:300px;">
                            <label>Standardbild Typ B</label>
                            <p>Legen Sie das Standardbild für den Slider Typ B im responsive Mode fest.</p>
                        </td>
                        <td>
							<?php echo $args["slider-responsive-default-image"]; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <input type="submit" name="f12s_slider_settings" value="Speichern"/>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("form#f12s_slider_settings").F12FormValidate();
    });
</script>