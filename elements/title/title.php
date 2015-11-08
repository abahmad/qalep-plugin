<?php

/*
  Element Name: Title
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 *@package Qalep\elements\title
 */

namespace Qalep\elements\title;

use Qalep\Classes\Core\Element;

class Title extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('Title', 'qalep'),
            'type' => 'title',
            'properties' => array(
                'Title' => 'title',
                __('Border', 'qalep') => array(
                    'input_type' => "radio",
                    'choices' => array(
                        "bottom" => 'two-btm',
                        "around" => 'two-side'
                    ),
                    "value" => 'two-btm',
                ),
                __('Alignment', 'qalep') => array(
                    'input_type' => "radio",
                    'choices' => array(__('center', 'qalep') => 'text-center', __('left', 'qalep') => 'text-left', __('right', 'qalep') => 'text-right'),
                    "value" => 'text-left',
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

        return '<div class="item" >
            {{item.label}}
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            </div>
            </div>';
    }

}
