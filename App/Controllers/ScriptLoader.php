<?php

/**
 * load all scripts needed  for qalep plugin
 * @package Qalep\App\Controllers
 */

namespace Qalep\App\Controllers;

use Qalep\Classes\Core\Controller;

class ScriptLoader extends Controller {

    public function __construct() {

        parent::__construct();
        $this->load_scripts();

        $this->scripts->run();
    }

    public function load_scripts() {

        $this->scripts->addAdminScript(array('angularjs', asset('assets.js', 'angular-min.js')));
        $this->scripts->addAdminScript(array('angular-sanitize', asset('assets.js', 'angular-sanitize.min.js')));
        $this->scripts->addAdminScript(array('bootstrap-js', asset('bower_components.bootstrap-css.js', 'bootstrap.min.js')));
        $this->scripts->addAdminScript(array('angular-drag-and-drop-lists', asset('assets.js', 'angular-drag-and-drop-lists-min.js')));
        $this->scripts->addAdminScript(array('angular-drag', asset('assets.js', 'angular-drag.js')));
        $this->scripts->addAdminScript(array('qalep-jquery', asset('assets.js', 'qalep-jquery.js')));
        $this->scripts->addAdminScript(array('jquery-ui-dialog'));
        $this->scripts->addAdminScript(array('angular-mocks','http://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-mocks.js'));

        // wp_enqueue_script('color-picker', plugins_url().'/qalep/inputs/color_picker/js/picker.js');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');

        //for uplaod image button
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
    }

    public function load_styles() {

        $lang = self::get_current_lang();
        $this->scripts->addAdminStyle(array("query-ui", "http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"));
        $this->scripts->addAdminStyle(array('qalep-bootstrap', asset('assets.css', 'qalep-bootstrap.css')));
        $this->scripts->addAdminStyle(array('qalep-drag-drop', asset('assets.css', 'qalep-drag-drop.css')));
        $this->scripts->addAdminStyle(array('style_' . $lang, asset('assets.css', 'style-' . $lang . '.css')));
//        if (is_rtl())
//            $this->scripts->addAdminStyle(array('qalep-rtl', asset('assets.css', 'qalep-rtl.css')));
    }

    static function load_forntend_styles() {

        wp_enqueue_style('bootstrap', asset('assets.css', 'bootstrap.min.css'));
        wp_enqueue_style('stylesheet', asset('assets.css', 'stylesheet.css'));
        wp_enqueue_style('font-awesome.min', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
        //for counting element on front end
        wp_enqueue_script("jquery.circle-diagram", plugins_url('/../assets/js/jquery.circle-diagram.js', __FILE__));
        wp_enqueue_script("main", plugins_url('/../assets/js/main.js', __FILE__));
    }

    static function get_current_lang() {
        $lang = get_bloginfo("language");
        $lang = substr($lang, 0, 2);
        return $lang;
    }

    static function load_shortcode_button_js_file() {
        wp_enqueue_script('shortcode-button', plugins_url('', __FILE__) . '/../assets/js/shortcode-button.js', array('jquery'), '1.0', true);
    }

}
