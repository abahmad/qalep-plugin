<?php

/*
  Element Name: Content_box
 * Author : mnbaa
 * Description:Type block of text
 */

namespace Qalep\elements\content_box;

use Qalep\Classes\Core\Element;

class Content_box extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('pargraph', 'qlp'),
            'type' => 'paragraph',
            'properties' => array(
                'template' => array(
                    'input_type' => "radio",
                    'choices' => array('box1', 'box2', 'box3'),
                    "value" => 'box1',
                ),
                'title' => 'TITLE OF THE BLOCK IN HERE',
                'text' => 'Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.',
            ),
        );

        //create the block
        parent::__construct($block_options);
    }

    /*
     * draw template for element on draged on area
     */

    public function draw_template() {

        return '<div class="item" ng-click="draw(models.selected.properties)" >{{item.label}}
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            </div>
            </div>';
    }

}
