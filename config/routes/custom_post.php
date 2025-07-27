<?php

return array(
    'custom_post' => array(
        array(
            'route_slug' => 'custom_post',
            'hook_name' => 'init',
            'hook_class' => 'Qalep\App\Controllers\CustomPost',
            'callback' => '_create_post_type_template',
        ),
        array(
            'route_slug' => 'custom_post',
            'hook_name' => 'add_meta_boxes',
            'hook_class' => 'Qalep\App\Controllers\CustomPost',
            'callback' => ' _add_qalep_metaboxes',
        )
    )
);
