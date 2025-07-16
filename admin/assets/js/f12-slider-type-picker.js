(function($){
    "use strict";

    $(document).ready(function(){
        $("#f12s_meta_box_slider_content input[type='radio']").on("click",function(){
            f12_slider_show_by_type($(this).val());
        });

        $("#f12s_meta_box_slider_content").find("input[type='radio']").each(function(){
            if($(this).attr("checked")){
                f12_slider_show_by_type($(this).val());
            }
        });
    });

    function f12_slider_show_by_type(type){
        switch(type){
            case 'a':
                $("#f12s_meta_box_slider_type_a").show();
                $("#f12s_meta_box_slider_type_b").hide();
                break;
            case 'b':
                $("#f12s_meta_box_slider_type_b").show();
                $("#f12s_meta_box_slider_type_a").hide();
                break;

        }
    }
})(jQuery);