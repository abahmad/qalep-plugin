<?php

/**
 * To draw inputs
 * @package Qalep\Classes\Core
 */

namespace Qalep\Classes\Core;

class Input {

    function text() {
        return "<input type='text'  ng-model='models.selected.properties[key].value' />";
    }

    public function radio($choises) {
        $result = '';
        foreach ($choises as $key => $choise) {
            $result.= '<input type="radio" value ="' . $choise . '"  ng-model="models.selected.properties[key].value"> <span>' . $key . ' </span>';
        }
        return $result;
    }

    public function checkbox($choises) {

        $result = '';
        foreach ($choises as $key => $choise) {
            $result.= '<input type="checkbox"  ng-true-value="models.selected.properties[key].value"  value="Cat" /><span>' . $key . ' </span>';
        }
        return $result;
    }

    function textarea() {
        return '<textarea cols="60" rows="4" ng-model="models.selected.properties[key].value"></textarea>';
    }

    function image() {
        return ' <div class="item" id="{{item.id}}" >
                <input  ng-click="uploadImg($event, $index)" class="custom_upload_image_button button" type="button" value="' . __('Choose Image', 'qalep') . '" />
                <img ng-src="{{models.selected.properties[key].value}}"  class="custom_preview_image" alt="" id="image_img"  .value" />
                <br><a href="#" my-change="list"  ng-click="removeImg($event)" class="custom_clear_image_button">' . __('Remove Image', 'qalep') . '</a>
                <input name="image" type="text" class="custom_upload_image ng-hide" value=""  id="image_ID" ng-model="models.selected.properties[key].value" />
            </div>';
    }

}
