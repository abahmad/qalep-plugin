<?php

/*
  Element Name: Content_box
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 *@package Qalep\elements\content_box
 */
namespace Qalep\elements\content_box;

use Qalep\Classes\Core\Element;

class Content_box extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('content box', 'qalep'),
            'type' => 'content_box',
            'properties' => array(
                __('template', 'qalep') => array(
                    'input_type' => "radio",
                    'choices' => array(__('template1','qalep') => 'box1', __('template2','qalep') => 'box2',__('template3','qalep') => 'box3'),
                    "value" => 'box1',
                ),
                __('title', 'qalep') => 'TITLE OF THE BLOCK IN HERE',
                __('text', 'qalep') => array(
                    'input_type' => 'textarea',
                    "value" => ''
                ),
            ),
        );

        //create the block
        parent::__construct($block_options);
    }

    /*
     * draw template for element on draged on area
     */

    public function draw_template() {

        return '<div class="item" ng-click="draw(models.selected.properties)" >{{item.label}}
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            </div>
            </div>';
    }

}
