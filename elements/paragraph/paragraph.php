<?php

/*
  Element Name: Paragraph
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 *@package Qalep\elements\paragraph
 */
namespace Qalep\elements\paragraph;

use Qalep\Classes\Core\Element;

if (!class_exists('Paragraph')) {

    class Paragraph extends Element {

        public function __construct() {
            $block_options = array(
                'label' => __('Pargraph', 'qalep'),
                'type' => 'paragraph',
                'properties' => array(
                    __('title', 'qalep') => ' ',
                    __('text', 'qalep') => array(
                        'input_type' => 'textarea',
                        'value' => 'Your text here'),
                    __('textalign', 'qalep') => array(
                        'input_type' => "radio",
                        'choices' => array(__('center','qalep') => 'text-center', __('justify','qalep') => 'center'),
                        "value" => 'text-center'
                    ),
                    __('quotes', 'qalep') => array(
                        "input_type" => 'radio',
                        "choices" => array('true' => TRUE, "flase" => FALSE),
                        "value" => TRUE
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
