<?php

namespace Qalep\App\Controllers;

use Qalep\Classes\Core\Controller;

class ScriptLoader extends Controller {

    public function __construct() {
        parent::__construct();
        $this->scripts->addAdminStyle(array("query-ui", "http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"));
        //
        $this->scripts->addAdminScript(array('angularjs', asset('assets.js', 'angular-min.js')));
        $this->scripts->addAdminScript(array('angular-sanitize', asset('assets.js', 'angular-sanitize.min.js')));
        $this->scripts->addAdminScript(array('bootstrap-js', asset('bower_components.bootstrap-css.js', 'bootstrap.min.js')));
        $this->scripts->addAdminScript(array('angular-drag-and-drop-lists', asset('assets.js', 'angular-drag-and-drop-lists-min.js')));
        $this->scripts->addAdminScript(array('angular-drag', asset('assets.js', 'angular-drag.js')));
        //$this->scripts->addAdminScript(array('qalep-elements', asset('assets.js', 'qalep-elements.js')));
        $this->scripts->addAdminScript(array('qalep-jquery', asset('assets.js', 'qalep-jquery.js')));
        $this->scripts->addAdminScript(array('jquery-ui-dialog'));
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        $this->scripts->run();
    }

    static function load_scripts() {

        // load scripts for image media box
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');

        // load kalep elements script
        wp_enqueue_script("qalep-elements", plugins_url('', __FILE__) . '/../assets/js/qalep-elements.js');

        // load angular and dragdrop angular library
        wp_enqueue_script("angular", plugins_url('', __FILE__) . '/../assets/js/angular.js');
        wp_enqueue_script("angular-drag-and-drop-lists.min", plugins_url('', __FILE__) . '/../assets/js/angular-drag-and-drop-lists.min.js');
        wp_enqueue_script("angular_drag", plugins_url('', __FILE__) . '/../assets/js/angular-drag.js');

        //load jquery function of perview button and option page 
        wp_enqueue_script("jquery-elements", plugins_url('', __FILE__) . '/../assets/js/jquery-elements.js');

        // load ajax scripts for perview popup 
        wp_localize_script('jquery-elements', 'previewAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

        //pop up window
        wp_enqueue_script('jquery-ui-dialog');
    }

    public function load_styles() {
        $lang = self::get_current_lang();
        $this->scripts->addAdminStyle(array('qalep-bootstrap', asset('assets.css', 'qalep-bootstrap.css')));
        $this->scripts->addAdminStyle(array('qalep-drag-drop', asset('assets.css', 'qalep-drag-drop.css')));
        $this->scripts->addAdminStyle(array('style_en', asset('assets.css', 'style-' . $lang . '.css')));
    }

    static function load_forntend_styles() {

        wp_enqueue_style('bootstrap', plugins_url('', __FILE__) . '/../assets/css/bootstrap.min.css');
        wp_enqueue_style('stylesheet', plugins_url('/../assets/css/stylesheet.css', __FILE__));
        wp_enqueue_style('font-awesome.min', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
        //for counting elemnt on front end
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
