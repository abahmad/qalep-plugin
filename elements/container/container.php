<?php

/*
  Element Name: Container
 * Author : mnbaa
 * Description:bootstarp container
 */

namespace Qalep\elements\container;

use Qalep\Classes\Core\Element;

if (!class_exists('Container')) {

    class Container extends Element {

        public function __construct() {
            $block_options = array(
                "label" => __('Conatiner', 'qalep'),
                "type" => 'container',
                "columns" => array(array()),
                "properties" => array(
                    __("fixed", 'qalep') => array(
                        "input_type" => "radio",
                        "choices" => array("True" => 'true', "False" => 'false'),
                        "value" => 'true'
                    )
                )
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
            return '<div class="container-fluid">
            <div class="container-element box box-blue">     
            <h3>{{item.label}}</h3>
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            <div class="clearfix"></div>
            </div></h3>
            <div class="row" ng-repeat="list in item.columns" ng-include="\'list.html\'"></div>
            <div class="clearfix"></div>
            </div>
            </div>';
//           
        }

    }

}
