<?php

/*
  Element Name: Counting
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 *@package Qalep\elements\counting
 */
namespace Qalep\elements\counting;

use Qalep\Classes\Core\Element;

class Counting extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('Counting', 'qalep'),
            'type' => 'counting',
            'properties' => array(
                __("percent", 'qalep') => "34.2%",
                __("size", 'qalep') => "200",
                __("borderWidth", 'qalep') => "40",
                __("bgFill", 'qalep') => "#f7f7f7",
                __("frFill", 'qalep') => "#fa9011",
                __("textSize", 'qalep') => "15",
                __("textColor", 'qalep') => "#585858"
            )
        );

        //create the block
        parent::__construct($block_options);
    }

    /*
     * draw template for element on draged on area
     */

    public function draw_template() {

        return '<div class="item">
            {{item.label}}
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            </div>
            </div>';
    }

}
