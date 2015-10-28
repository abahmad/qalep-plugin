<?php

namespace Qalep\App\Controllers;

use Qalep\Classes\Core\Controller;

/*
 * register custom post qalep to wordpress
 */

class CustomPost extends Controller {

    public function __construct() {
        parent::__construct();


        DI()->get('Qalep\App\Controllers\ScriptLoader')->load_styles();

        //
        add_action('add_meta_boxes', array(&$this, '_add_qalep_metaboxes'));
        add_action('admin_menu', array(&$this, 'register_options_menu_page'));
        add_action('admin_enqueue_scripts', array(&$this, 'qalep_remove_auto_save'));
    }

    // pass data to bulider view page 
    public function index() {

        $template_items = DI()->get('Qalep\App\Controllers\Templater')->check_sync();

        $elements = DI()->get('Qalep\App\Controllers\ListAllElement');

        //$elements->register_bultin_element();
        $template_content = $elements->search_elements();
        $user_shortcode = $elements->get_registed_shortcodes();

        $this->view('builder', array('user_shortcode' => $user_shortcode,
            'template_content' => $template_content, 'template_items' => $template_items));
    }

    //register qalep custom post in init action
    public function _create_post_type_template() {

        register_post_type('qalep', array(
            'labels' => array(
                'name' => __('Qalep', 'qalep'),
                'singular_name' => __('qalep', 'qalep'),
                'add_new' => __('Add New Template', 'qalep'),
                'edit_item' => __('Edit Template', 'qalep'),
                'new_item' => __('Add New Template', 'qalep'),
                'view_item' => __('View Template', 'qalep'),
                'search_items' => __('Search Template', 'qalep'),
                'not_found' => __('No Templates found', 'qalep'),
                'not_found_in_trash' => __('No Templates found in trash', 'qalep'),
            ),
            'show_ui' => true,
            'public' => true,
            'rewrite' => array('slug' => 'qalep'),
            'supports' => array('title'),
                )
        );

        // 
    }

    //add option page
    public function register_options_menu_page() {
        $shortcode = DI()->get('Qalep\App\Controllers\ShortCode');
        add_submenu_page('edit.php?post_type=qalep', 'qalep options', __('Qalep options', 'qalep'), 'manage_options', 'qalep_options', array($shortcode, 'shortcode_options')
        );
    }

    //add meta box to qalep custom post
    public function _add_qalep_metaboxes() {
        add_meta_box('wpt_qalep', __('Bulid Your template', 'qalep'), array(&$this, 'index'), 'qalep', 'normal', 'default'
        );
    }

    //to remove autosave when submit with custom save button
    public function qalep_remove_auto_save() {
        global $post;
        if (isset($post) && $post->post_type == "qalep") {
            wp_dequeue_script('autosave');
        }
    }

    // to view link dublicate for every template post and remove other unneeded links
    static function qalep_action_row($actions, $post) {
        if ($post->post_type == "qalep") {
            //remove what you don't need
            unset($actions['inline hide-if-no-js']);
            unset($actions['view']);
            //check capabilites

            $actions['clone'] = '<a href="admin.php?action=rd_duplicate_post&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">' . __("Duplicate", "qalep") . '</a>';
        }
        return $actions;
    }

}
