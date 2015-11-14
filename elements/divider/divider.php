<?php

/*
  Element Name: Divider
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 * @package Qalep\elements\divider
 */

namespace Qalep\elements\divider;

use Qalep\Classes\Core\Element;

class Divider extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('divider', 'qalep'),
            'type' => 'divider',
            'properties' => array(
                __('shape', 'qalep') => array(
                    'input_type' => 'radio',
                    'choices' => array(__('thin','qalep') => 'thin', __('dashed','qalep') => 'dashed', __('slash','qalep') => 'slash'),
                    'value' => 'thin'
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
