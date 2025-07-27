jQuery(function ($) {
    $(document).ready(function () {
        $('body').on('click', '#qalep-inert-shortcode', function () {
            var id = jQuery('#qalep_templates').val();

            /** Alert user if there is no template selected */
            if ('' == id) {
                alert("<?php echo esc_js( __( 'Please select your template first!', 'kalep' ) ); ?>");
                return;
            }

            /** Send shortcode to editor */
            window.send_to_editor('[qalep template id="' + id + '"]');

        });

    });

});