<?php

/*
  Element Name: Button
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 * @package Qalep\elements\button
 */
namespace Qalep\elements\button;

use Qalep\Classes\Core\Element;

class Button extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('button', 'qalep'),
            'type' => 'button',
            'properties' => array(
                "value" => 'button',
                __("border", 'qalep') => array(
                    "input_type" => "radio",
                    "choices" => array(__('flat','qalep') => 'flat', __('round','qalep') => 'round'),
                    "value" => 'flat'
                ),
                __("color", "qalep") => array(
                    "input_type" => "radio",
                    "choices" => array(__('gray','qalep') => 'gray',__('white','qalep') => 'orange-trans-btn',__('orange','qalep') => 'orange'),
                    "value" => "white"
                ),
                __("size", 'qalep') => array(
                    "input_type" => "radio",
                    "choices" => array(__("small",'qalep') => 'sm', __("medium",'qalep') => 'md',__("larag",'qalep') => "lg"),
                    "value" => 'md',
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
