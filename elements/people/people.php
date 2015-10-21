<?php

/*
  Element Name: People
 * Author : mnbaa
 * Description:Type block of text
 */

namespace Qalep\elements\people;

use Qalep\Classes\Core\Element;

class People extends Element {

    public function __construct() {
        $block_options = array(
            'type' => 'people',
            'properties' => array(
                "name" => 'FULL NAME IN HERE',
                "position" => 'position here',
                "template" => array(
                    "input_type" => "radio",
                    "choices" => array('template1' => '1', "template2" => '2', 'template3' => '3', 'template4' => '4'),
                    "value" => '1'
                ),
                "social" => array(
                    "input_type" => "checkbox",
                    "choices" => array('Facebook' => 'f', "Twitter" => 't', 'Google+' => 'g+', 'Pinterest' => 'p'),
                    "value" => 'f',
                ),
                "color" => array(
                    "input_type" => 'color_picker',
                    "value " => "red"
                ),
                "text" => array(
                    'input_type' => "textarea",
                    "value" => "type your text here"
                ),
                "image" => array("input_type" => 'image',
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
