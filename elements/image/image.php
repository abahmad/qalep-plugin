<?php

/*
  Element Name: Image
 * Author : mnbaa
 * Description:Type block of text
 */

namespace Qalep\elements\image;

use Qalep\Classes\Core\Element;

if (!class_exists('Paragraph')) {

    class Image extends Element {

        public function __construct() {
            $block_options = array(
                'label' => __('Image', 'qalep'),
                'type' => 'image'
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

            return '<div class="item" id="{{item.id}}" >
                <div>
                <img src="{{item.imgSrc}}" class="custom_preview_image" alt="" id="image_img" />
                <input  ng-click="uploadImg($event,$index)" class="custom_upload_image_button button" type="button" value="'.__('Choose Image','qalep').'" />
                <br><a href="#"  ng-click="removeImg($event)" class="custom_clear_image_button">'.__('Remove Image','qalep').'</a>
                <input name="image"  type="text" class="custom_upload_image ng-hide" ng-model="item.imgSrc" id="image_ID" />
                </div>
                <div class="item-actions">
                <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
                <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
                </div>
            </div>';
        }

    }

}
