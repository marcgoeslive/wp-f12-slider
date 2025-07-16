(function ($) {
    $(function () {

        if (typeof($.fn.wpColorPicker) !== "undefined") {
            // Add Color Picker to all inputs that have 'color-field' class
            $('.f12-color-picker').wpColorPicker();
        }

    });
})(jQuery);