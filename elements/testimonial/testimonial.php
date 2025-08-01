<?php

/*
  Element Name: Testimonial
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 *@package Qalep\elements\testimonial
 */

namespace Qalep\elements\testimonial;

use Qalep\Classes\Core\Element;

class Testimonial extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('Testimonial', 'qalep'),
            'type' => 'testimonial',
            'properties' => array(
                __('personName', 'qalep') => '',
                __('personPosition', 'qalep') => '',
                __('text', 'qalep') => array(
                    'input_type' => "textarea",
                    "value" => 'text here'
                ),
                __('image', 'qalep') => array(
                    "input_type" => 'image',
                    "value" => '',
                ),
                __('template', 'qalep') => array(
                    'input_type' => "radio",
                    'choices' => array('in box', 'with popup'),
                    "value" => 'in box',
                ),
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
