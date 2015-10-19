<?php

/*
  Element Name: Column
 * Author : mnbaa
 * Description:bootstarp column
 */

namespace Qalep\elements\column;

use Qalep\Classes\Core\Element;

if (!class_exists('Column')) {

    class Column extends Element {

        public function __construct() {
            $block_options = array(
                "label" => 'Column',
                "type" => 'column',
                "columns" => array(array()),
                "properties" => array(
                    "width" => '12',
                    "offset" => '0'
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
            return '<div class="container-element box box-blue col-md-{{item.properties.width}}">
            <h3>Column</h3>
            <div class="qalep-col-inner" ng-repeat="list in item.columns" ng-include="\'list.html\'">
            <div class="clearfix"></div>
            </div>
            </div>';
//           
        }

    }

}
