jQuery(document).ready(function($){
    $('#upload_image_button_slider').click(
        function () {
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            return false;
        }
    );
});


window.send_to_editor = function(html){
    var src = jQuery(html).attr("src");

    jQuery("#media-js input[name='image']").val(src);
    jQuery("#media-js img").remove();

    jQuery("#media-js").append("<img src='' style='max-width:100%;'>");
    jQuery("#media-js img").attr("src",src);

    // Remove the thickbox
    self.parent.tb_remove();

};