<?php

return array(
    'admin_menu' => array(
        array(
            'route_slug' => 'admin_menu',
            'hook_name' => 'init',
            'hook_class' => 'Qalep\App\Controllers\FrontPage',
            'callback' => '_add_admin_menu_page',
        ),
        
    )
);
