<?php

/*
  Element Name: People
 * Author : mnbaa
 * Description:Type block of text
 */
/**
 * @package Qalep\elements\people
 */
namespace Qalep\elements\people;

use Qalep\Classes\Core\Element;

class People extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('people', 'qalep'),
            'type' => 'people',
            'properties' => array(
                __("name", 'qalep') => 'FULL NAME IN HERE',
                __("position", 'qalep') => 'position here',
                __("template", 'qalep') => array(
                    "input_type" => "radio",
                    "choices" => array(__('template1','qalep') => '1', __("template2",'qalep') => '2',__('template3','qalep') => '3', __('template4','qalep') => '4'),
                    "value" => '1'
                ),
                __("background_color", 'qalep') => array(
                    "input_type" => 'color_picker',
                    "value" => "#eeee22"
                ),
                __("text", 'qalep') => array(
                    'input_type' => "textarea",
                    "value" => "type your text here"
                ),
                __("image", 'qalep') => array("input_type" => 'image',
                    "value" => ""
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
