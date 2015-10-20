<?php

/*
  Element Name: text
 * Author : mnbaa
 * Description:Type block of text
 */

namespace Qalep\elements\text;

use Qalep\Classes\Core\Element;

if (!class_exists('Text')) {

    class Text extends Element {

        public function __construct() {
            $block_options = array(
                'type' => 'text',
                "properties" => array(
                    "Text" => array(
                        "input_type" => 'textarea',
                        "value" => "type your text here"
                    )
                ),
            );

            //create the block
            parent::__construct($block_options);
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }

            return $this;
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
