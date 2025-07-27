
(function ($) {
    // Add Color Picker to all inputs that have 'color-field' class
    $(function () {

        $('.color-field').wpColorPicker();

    });
})(jQuery);

jQuery(document).ready(function () {
    alert($('.color-field'));
    $(".color-field").keyup(function () {
        alert("Handler for .keyup() called.");
    });
});