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
                'label' => __('pargraph', 'qlp'),
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
            <img src="{{item.imgSrc}}" class="custom_preview_image" alt="" id="image_img" />
            <input  ng-click="uploadImg($event,$index)" class="custom_upload_image_button button" type="button" value="Choose Image" />
            <br><a href="#"  ng-click="removeImg($event)" class="custom_clear_image_button">Remove Image</a>
            <input name="image" type="hidden" class="custom_upload_image" value="1" id="image_ID" ng-model="item.imgId" />
            </div>';
        }

    }

}
