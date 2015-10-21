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
            return '<div class="col-md-{{item.properties.width}}">
            <div class="container-element box box-blue">
                        <h3>Column
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            <div class="clearfix"></div>
            </div></h3>
            <div class="qalep-col-inner" ng-repeat="list in item.columns" ng-include="\'list.html\'"></div>
            <div class="clearfix"></div>            
            </div>
            </div>';
//           
        }

    }

}
