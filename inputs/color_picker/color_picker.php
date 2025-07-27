<?php

namespace Qalep\inputs\color_picker;

class color_picker {

    public function __construct() {
        wp_enqueue_style('wp-color','style.css');
        //add_action('admin_enqueue_scripts', array($this, 'wpse_80236_Colorpicker'));
       // $this->wpse_80236_Colorpicker();
    }

    public function wpse_80236_Colorpicker() {

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }

    function draw() {
        return '<span  class="bg-color" style="background-color:{{models.selected.properties[key].value}};"></span><input ng-init="load_color()"  class="color-field" type="text" name="post_bg" ng-model="models.selected.properties[key].value"/>';
    }

}
