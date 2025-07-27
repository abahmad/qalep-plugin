<?php

/*
  Element Name: Post
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 * @package Qalep\elements\post
 */

namespace Qalep\elements\post;

use Qalep\Classes\Core\Element;

class Post extends Element {

    public $block_options = array();

    public function __construct() {

        $this->block_options = array(
            'label' => __('post', 'qalep'),
            'type' => 'post',
            'properties' => array(
                __("numberposts", 'qalep') => '1',
                __("post_type", 'qalep') => array(
                    'input_type' => 'selectcustom',
                    "choices" => $this->get_custom_posts(),
                    'value' => 'post'
                ),
                __("post_meta_fileds", 'qalep') => array(
                    'input_type' => 'custom_checkboox',
                    "choices" => $this->get_custom_meta(),
                    'value' => '',
                ),
                __("taxnomy", 'qalep') => array(
                    'input_type' => 'checkbox',
                    "choices" => $this->get_all_taxonomies(),
                    'value' => ''
                ),
                __("pagination", 'qalep') => array(
                    "input_type" => "radio",
                    "choices" => array(
                        "pagination-default",
                        "pagination-soft",
                        "pagination-color",
                        "pagination-cir"
                    ),
                    "value" => 'pagination-default',
                )
            )
        );

        //create the block
        parent::__construct($this->block_options);
    }

    /*
     * draw template for element on draged on area
     */

    public function draw_template() {

        return '<div class="item" >
            {{item.label}}
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            </div>
            </div>';
    }

    public function get_custom_posts() {
        $args = array(
            'public' => true,
        );
        $post_types = get_post_types($args);
        $posts=array();
        foreach ($post_types as $key =>$val){
           $posts['label']=$key;
           $posts['value']=$val;
            
        }
        return $post_types;
    }

    function get_custom_meta() {
        $result = array();
        $posts = $this->get_custom_posts();
        // $html='';
        foreach ($posts as $value) {
            $res = $this->generate_meta_keys($value);
            $result[$value] = $res;
        }
        //var_dump($result);
        return $result;
    }

    function generate_meta_keys($post_type) {
        global $wpdb;
//        $props = json_decode(file_get_contents("php://input"));
//        $post_type = $props->post_type;
        //$post_type = 'qalep';
        $query = "
        SELECT DISTINCT($wpdb->postmeta.meta_key) 
        FROM $wpdb->posts 
        LEFT JOIN $wpdb->postmeta 
        ON $wpdb->posts.ID = $wpdb->postmeta.post_id 
        WHERE $wpdb->posts.post_type = '%s' 
        AND $wpdb->postmeta.meta_key != '' 
        AND $wpdb->postmeta.meta_key NOT RegExp '(^[_0-9].+$)' 
        AND $wpdb->postmeta.meta_key NOT RegExp '(^[0-9]+$)'";
        $meta_keys = $wpdb->get_col($wpdb->prepare($query, $post_type));
        $response = array_flip($meta_keys);
        return $response;
//    
    }

    function get_all_taxonomies() {
        $taxonomy_objects = get_object_taxonomies('qalep');
        return array_flip($taxonomy_objects);
    }

}
