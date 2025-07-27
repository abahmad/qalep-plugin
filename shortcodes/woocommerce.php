<?php

if (is_plugin_active('woocommerce/woocommerce.php'))
    return array(
        'cart' => array(
            'label' => __('WooCommerce Cart', 'qalep'),
            'type' => 'shortcode',
            'shortcode_base' => 'woocommerce_cart')
        ,
        'checkout' => array(
            'label' => __('WooCommerce Checkout', 'qalep'),
            'type' => 'shortcode',
            'shortcode_base' => 'woocommerce_checkout'
        ),
        'tracking' => array(
            'label' => __('WooCommerce Order Tracking', 'qalep'),
            'type' => 'shortcode',
            'shortcode_base' => 'woocommerce_order_tracking'
        ),
        array(
            'label' => __('WooCommerce My Account', 'qalep'),
            'type' => 'shortcode',
            'shortcode_base' => 'woocommerce_my_account',
            "properties" => array(
                __("order_count", 'qalep') => array(
                    "input_type" => "number",
                    "value" => 15
                )
            )
        )
    );
?>