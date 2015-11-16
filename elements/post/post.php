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

    public $block_options=array();
    public function __construct() {

        $this->block_options = array(
            'label' => __('post', 'qalep'),
            'type' => 'post',
            'properties' => array(
                __("numberposts", 'qalep') => '1',
                __("post_type", 'qalep') => array(
                    'input_type' => 'select',
                    "choices" => $this->get_custom_posts(),
                    'value' => 'post'
                ),
                __("post_meta_fileds", 'qalep') => array(
                    'input_type' => 'checkbox',
                    "choices" => '',
                    'value' => array(),
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
        return $post_types;
    }

    function generate_meta_keys() {
        global $wpdb;
        $props = json_decode(file_get_contents("php://input"));
        $post_type = $props->post_type;

        $query = "
        SELECT DISTINCT($wpdb->postmeta.meta_key) 
        FROM $wpdb->posts 
        LEFT JOIN $wpdb->postmeta 
        ON $wpdb->posts.ID = $wpdb->postmeta.post_id 
        WHERE $wpdb->posts.post_type = '%s' 
        AND $wpdb->postmeta.meta_key != '' 
        AND $wpdb->postmeta.meta_key NOT RegExp '(^[_0-9].+$)' 
        AND $wpdb->postmeta.meta_key NOT RegExp '(^[0-9]+$)'
    ";
        $meta_keys = $wpdb->get_col($wpdb->prepare($query, $post_type));
        $response=array_flip($meta_keys);
        $this->block_options['properties']['post_meta_fileds']['value']=$response;
        //print_r($this->block_options);
        $result = \DI()->get('Qalep\Classes\Core\Input')->checkbox($response);
//        $result='';
//        foreach ($response as $key=>$val){
//            $result .='<input type="checkbox" value="'.$val.'">'.$key;
//        }
//        $result .= '<label ng-repeat="(itemName,val) in models.selected.properties[key].choices">
//        <input type="checkbox"  value="{{itemName}}" ng-checked="models.selected.properties[key].value.indexOf(itemName) > -1" ng-click="toggleSelection(itemName,key)"> {{itemName}}
//        </label>';
        // set_transient('foods_meta_keys', $meta_keys, 60*60*24) # 1 Day Expiration
       // print_r(array_flip($meta_keys));
       echo $result;
        die();
    }

    function get_all_taxonomies() {
        $taxonomy_objects = get_object_taxonomies('qalep');
        return array_flip($taxonomy_objects);
    }

}
