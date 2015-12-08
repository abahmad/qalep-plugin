<?php

/*
 * create template and assign  it to page templates of wordpress
 * @package Qalep\App\Controllers
 */

namespace Qalep\App\Controllers;

use Qalep\Classes\Core\Controller;

class Templater extends Controller {

    /**
     * A Unique Identifier
     */
    protected $plugin_slug;

    /**
     * A reference to an instance of this class.
     */
    private static $instance;

    /**
     * The array of templates that this plugin tracks.
     */
    protected $templates;

    /**
     * @Return an instance of this class.
     */
    public static function get_instance() {

        if (null == self::$instance) {
            self::$instance = new Templater();
        }

        return self::$instance;
    }

    /**
     * Initializes the plugin by setting filters and administration functions.
     */
    function __construct() {

        $this->templates = array();

        // Add a filter to the attributes metabox to inject template into the cache.
        add_filter('page_attributes_dropdown_pages_args', array($this, '_register_project_templates'));


        // Add a filter to the save post to inject out template into the page cache
        add_filter('wp_insert_post_data', array($this, '_register_project_templates'));


        // Add a filter to the template include to determine if the page has our
        // template assigned and return it's path
        add_filter('template_include', array($this, 'view_project_template'));

        //save post
        add_action('save_post_qalep', array($this, 'save_template_data'));

        //clone the template
        add_action('admin_action_rd_duplicate_post', array($this, 'qalep_clone_template'));

        //privew template with ajax
        add_action('wp_ajax_qalep_template_preview', array($this, 'qalep_template_preview'));
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     * @param array atts
     */
    public function _register_project_templates($atts) {
        $template_folder = plugin_dir_path(__DIR__) . '../page_templates';
        $files_with_root = scandir($template_folder);
        $files = array_slice($files_with_root, 2);
        $all = array();
        foreach ($files as $key => $file) {
            $contents = file_get_contents($template_folder . '/' . $file);
            $searchfor = 'Template Name:';
            $pattern = preg_quote($searchfor, '/');
            $pattern = "/^.* $pattern.*\$/m";
            //$pattern = preg_quote($searchfor, '/');
            //echo  $pattern;
            if (preg_match_all($pattern, $contents, $matches)) {
                $str = explode(':', $matches[0][0]);
                $this->templates[$file] = $str[1];
            }
        }

        unset($files);
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());
        // Retrieve the cache list.
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
        if (empty($templates)) {
            $templates = array();
        }

        // New cache, therefore remove the old one
        wp_cache_delete($cache_key, 'themes');
        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge($templates, $this->templates);

        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        // var_dump(wp_cache_get( $cache_key, 'themes' )) ;
        wp_cache_add($cache_key, $templates, 'themes', 1800);


        return $atts;
    }

    /**
     * Checks if the template is assigned to the page
     */
    public function view_project_template($template) {

        global $post;
        if ($post) {
            $template_name = get_post_meta($post->ID, '_wp_page_template', true);
            //  echo 'hhh' . $template_name;
            if ($template_name != '') {
                $file = plugin_dir_path(__DIR__) . '../page_templates/' . $template_name;
                // echo $file;
                // Just to be safe, we check if the file exist first
                if (file_exists($file)) {
                    return $file;
                }
//             else {
//               // echo $file;
//            }
            }
            return $template;
        }
    }

    /*
     * create page template file 
     */

    public function qalep_template_file($args = array(), $post) {

        $custom_template = $_POST['assign-template-to'];
        //Force Direct Filewrites For Upgrades
        add_filter('filesystem_method', create_function('$a', 'return "direct";'));

        //add post meta
        $meta_id = update_post_meta($post->ID, 'template_element', $args);
        $template_name = $post->post_title;
        if ($custom_template !== '') {
            $just_filename = $custom_template;
        } else {
            $just_filename = $post->post_name;
        }
        $theme_name = wp_get_theme();
        $content = '<?php /*
        * Template Name: ' . $template_name . '
        *
        * Description: A page template that provides a key component of WordPress as a CMS
        * by meeting the need for a carefully crafted introductory page. The front page template
        * in Twenty Twelve consists of a page content area for adding text, images, video --
        *
        * @package WordPress
        * @subpackage ' . $theme_name . '

        */?>
        ';
        $content .= '<?php ob_start();?><!-- <mnbaa_SEPERATOR> ' . json_encode($args) . '</mnbaa_SEPERATOR>--><?php ob_clean();?>';

        //write in template file
        $filename = $just_filename . '.php';
        $template_folder = plugin_dir_path(__DIR__) . '../page_templates';
        $full_path = $template_folder . "/" . $filename;

        if (file_exists($full_path)) {
            unlink($full_path);
        }

        $access_type = get_filesystem_method();
        if ($access_type == 'direct') {
            /* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
            $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

            /* initialize the API */
            if (!WP_Filesystem($creds)) {
                /* any problems and we exit */
                return false;
            }

            global $wp_filesystem;
            //$template_shortcode= $content;
            $content .='<?php do_shortcode("[qalep template id=' . $post->ID . ']"); ?>';
            if (!$wp_filesystem->put_contents($full_path, $content, 0777)) {
                echo 'error saving file!';
            }
            /* do our file manipulations below */
        } else {
            echo "failed";
            die();
        }
    }

    public function save_template_data() {
        // If it is our form has not been submitted, so we dont want to do anything
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        // echo "yes";
        if ($_POST) {

            $args = array();
            if (isset($_POST['item'])) {
                $args = $_POST['item'];
                $args = str_replace('\\', '', $args);
            }
            $img_id = 0;
            if (isset($_POST['image'])) {
                $img_id = $_POST['image'];
            }

            $post = get_post(get_the_ID());
            $this->qalep_template_file($args, $post, $img_id);
        }
    }

    //
    public function search_in_template() {
        global $post;
        $filename = $post->post_name;
        $plugin_path = plugin_dir_path(__DIR__) . '../page_templates';

        $filename = $filename . '.php';
        $full_path = $plugin_path . "/" . $filename;
        //
        if (file_exists($full_path)) {
            $contents = file_get_contents($full_path);
            $start_findme = '<mnbaa_SEPERATOR>';
            $start = strpos($contents, $start_findme) + strlen($start_findme);
            // echo $start;
            $end_findme = '</mnbaa_SEPERATOR>';
            $end = strpos($contents, '</mnbaa_SEPERATOR>');
            //$end=
            $template_content = substr($contents, $start, ($end - $start));
            return $template_content;
        } else {
            echo "page template file desn't exist";
        }
    }

    public function qalep_template_preview() {

        if (isset($_POST['items'])) {
            $items = $_POST['items'];
            $args = str_replace('\\', '', $items);
            $items = json_decode($args);
            DI()->make('Qalep\App\Controllers\FrontQalepDrawer', array('items' => $items));
        }
        die();
    }

    public function qalep_clone_template() {

        global $wpdb;
        if (!( isset($_GET['post']) || isset($_POST['post']) || ( isset($_REQUEST['action']) && 'rd_duplicate_post' == $_REQUEST['action'] ) )) {
            wp_die('No post to duplicate has been supplied!');
        }

        /*
         * get the original post id
         */
        $post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
        /*
         * and all the original post data then
         */
        $post = get_post($post_id);

        /*
         * if you don't want current user to be the new post author,
         * then change next couple of lines to this: $new_post_author = $post->post_author;
         */
        $current_user = wp_get_current_user();
        $new_post_author = $current_user->ID;

        /*
         * if post data exists, create the post duplicate
         */
        if (isset($post) && $post != null) {

            /*
             * new post data array
             */
            $title = $post->post_title . '-copy-';
            $args = array(
                'comment_status' => $post->comment_status,
                'ping_status' => $post->ping_status,
                'post_author' => $new_post_author,
                'post_content' => $post->post_content,
                'post_excerpt' => $post->post_excerpt,
                'post_name' => $post->post_name,
                'post_parent' => $post->post_parent,
                'post_password' => $post->post_password,
                'post_status' => $post->post_status,
                'post_title' => $title,
                'post_type' => $post->post_type,
                'to_ping' => $post->to_ping,
                'menu_order' => $post->menu_order
            );

            /*
             * insert the post by wp_insert_post() function
             */
            $new_post_id = wp_insert_post($args);

            /*
             * get all current post terms ad set them to the new post draft
             */
            $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
            foreach ($taxonomies as $taxonomy) {
                $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
            }

            /*
             * duplicate all post meta
             */
            $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
            if (count($post_meta_infos) != 0) {
                $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                foreach ($post_meta_infos as $meta_info) {
                    $meta_key = $meta_info->meta_key;
                    $meta_value = addslashes($meta_info->meta_value);
                    $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
                }
                $sql_query.= implode(" UNION ALL ", $sql_query_sel);
                $wpdb->query($sql_query);
            }


            /*
             * finally, redirect to the edit post screen for the new draft
             */
            wp_redirect(admin_url('edit.php?post_type=qalep'));
            exit;
        } else {
            wp_die('Post creation failed, could not find original post: ' . $post_id);
        }
    }

    //get image by ajax on back end  edit item
    static function qalep_get_image() {
        $image_id = $_POST['img_id'];
        $og_image = wp_get_attachment_image_src($image_id, 'medium');
        $og_image = $og_image[0];
        echo $og_image;
        //echo'<img src="' . $og_image . '" class="custom_preview_image" alt="" id="image_img' . '" />';
        die();
    }

    /* c
     * heck syncroniaztion between data on page templates
     * and data stored on post qalep meta
     */

    function check_sync() {

        global $post;
        $template_content = $this->search_in_template();

        if (isset($post)) {
            $template_items = (get_post_meta($post->ID, 'template_element', true));
        }
//          var_dump(json_decode($template_content));
//         echo "----------------";
//        var_dump($template_items);
        if (isset($template_items) && !empty($template_items)) {

            if (json_decode($template_content) == $template_items) {
                
            } else {
                echo "not synco";
            }
            return $template_items;
        }
    }

    /*
     * get values of each property for front end view
     */

    function qalep_get_value($props, $key_name) {
        $key = $props->$key_name;
        $value = $key->value;
        return $value;
    }

}

?>