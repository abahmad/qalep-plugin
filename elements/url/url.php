<?php

/*
  Element Name: Url
 * Author : mnbaa
 * Description:Type block of text
 */

/**
 * @package Qalep\elements\url
 */

namespace Qalep\elements\url;

use Qalep\Classes\Core\Element;

class Url extends Element {

    public function __construct() {
        $block_options = array(
            'label' => __('Title', 'qalep'),
            'type' => 'url',
            'properties' => array(
                __("slug",'qalep') => '',
               __("link",'qalep') => 'www.link.com'
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
