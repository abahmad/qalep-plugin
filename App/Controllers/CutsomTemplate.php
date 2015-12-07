<?php

/**
 * * register custom template
 * @package Qalep\App\Controllers
 */

namespace Qalep\App\Controllers;

use Qalep\Classes\Core\Controller;

class CutsomTemplate extends Controller {

    public function __construct() {
        add_filter('template_include', array($this, 'include_custom_template'), 1);
    }

    function include_custom_template($template_path) {
        $template_name = '';

        if (is_tax()) {
            $term = get_queried_object();
            if (!empty($term->slug)) {
                $taxonomy = $term->taxonomy;
                $template_name = "qalep-taxonomy-$taxonomy-{$term->slug}.php";
                get_author_template();
            }
        } elseif (is_single()) {
            $object = get_queried_object();
            if (!empty($object->post_type)) {
                $template_name = "qalep-single-{$object->post_type}.php";
            }
        } elseif (is_post_type_archive()) {
            get_post_type_archive_template();
//
        } elseif (is_category()) {
            $template_name = "qalep-category-{$category->slug}.php";
        } elseif (is_tag()) {
            $template_path = plugin_dir_path(__FILE__) . '/tag-work.php';
        } elseif (is_author()) {
            $author = get_queried_object();
            if ($author instanceof WP_User) {
                $template_name = "author-{$author->user_nicename}.php";
            }
        } elseif (is_archive()) {
            $post_types = array_filter((array) get_query_var('post_type'));
            $template_name = "qalep-archive-{$post_type}.php";
        }
        if (file_exists(plugin_dir_path(__DIR__) . '../page_templates/' . $template_name)) {
            $template_path = plugin_dir_path(__DIR__) . '../page_templates/' . $template_name;
        }
        return $template_path;
    }

}
