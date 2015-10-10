<?php

/*
  Element Name: Alert
 * Author : mnbaa
 * Description:Type block of text
 */

namespace Qalep\elements\alert;

use Qalep\Classes\Core\Element;

if (!class_exists('alert')) {

    class Alert extends Element {

        public function __construct() {
            $block_options = array(
                'type' => 'paragraph',
                'properties' => array(
                    "border" => "thin",
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

}
