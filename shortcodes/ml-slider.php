<?php

if (class_exists('MetaSliderPlugin')) {
    $sliders = array();

    // list the tabs
    $args = array(
        'post_type' => 'ml-slider',
        'post_status' => 'publish',
        'orderby' => 'date',
        'suppress_filters' => 1, // wpml, ignore language filter
        'order' => 'ASC',
        'posts_per_page' => -1
    );
    // WP_Query causes issues with other plugins using admin_footer to insert scripts
    // use get_posts instead
    $all_sliders = get_posts($args);

    foreach ($all_sliders as $slideshow) {

        $sliders[] = array(
            'value' => $slideshow->ID,
            'label' => $slideshow->post_title
        );
    }

    if (count($sliders) > 0) {
        return array(
            'ml-slider' => array(
                'label' => __('Meta Slider', 'qalep'),
                'type' => 'shortcode',
                'shortcode_base' => 'metaslider',
                'properties' => array(
                    'id' => array(
                        "label" => __('Slider name', 'qalep'),
                        "input_type" => "select",
                        "choices" => $sliders
                    )
                )
            )
        );
    }
}
?>