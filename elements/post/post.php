<?php

/*
  Element Name: Post
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 *@package Qalep\elements\post
 */

namespace Qalep\elements\post;

use Qalep\Classes\Core\Element;

class Post extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('post', 'qalep'),
            'type' => 'post',
            'properties' => array(
                __("numberposts", 'qalep') => '1',
                __("post_type", 'qalep') => '',
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
        parent::__construct($block_options);
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

}
