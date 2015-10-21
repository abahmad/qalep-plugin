<?php

/*
  Element Name: Button
 * Author : mnbaa
 * Description:Type block of text
 */

namespace Qalep\elements\button;

use Qalep\Classes\Core\Element;

class Button extends Element {

    public function __construct() {
        $block_options = array(
            'type' => 'button',
            'properties' => array(
                "value" => 'button',
                
                "border" => array(
                    "input_type" => "radio",
                    "choices" => array('flat'=>'flat','round'=>'round'),
                    "value" => 'flat'
                ),
                "color" =>array(
                    "input_type" => "radio",
                    "choices"    => array('gray'=>'gray', 'white'=>'white','orange'=>'orange'),
                    "value"      => "white"
                ),
                "size" => array(
                    "input_type" => "radio",
                    "choices"    => array("small"=>'sm',"medium"=>'md', "larag"=>"lg"),
                    "value"      => 'md',
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
