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
            'type' => 'paragraph',
            'properties' => array(
                "template" => array(
                    "input_type" => "text",
                    "value" => 'Default Text Hoda'
                ),
                " Social" => array(
                    "input_type" => "radio",
                    "choices" => array('f', 't', 'g+', 'p'),
                    "value" => 'f'),
                "name" => 'FULL NAME IN HERE',
                "position" => 'position here',
                "text" => "write description on",
                "image" => '',
                "color" => array(
                    "input_type" => 'color_picker',
                    "value " => "red"
                ),
                "count" => array(
                    "input_type" => 'text',
                    "value " => "red"
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
