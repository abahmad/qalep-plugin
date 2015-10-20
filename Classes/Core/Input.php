<?php

/*
 * To add inputs
 */

namespace Qalep\Classes\Core;

class Input {

    function text() {
        return "<input type='text'  ng-model='models.selected.properties[key].value' />";
    }

    public function radio($choises) {
        foreach ($choises as $key => $choise) {
            echo '<input type="radio" value ="' . $choise . '"  ng-model="models.selected.properties[key].value"><span>' . $key . ' </span>';
        }
    }

    function textarea() {
        echo '<textarea cols="60" rows="4" ng-model="models.selected.properties[key].value"></textarea>';
    }

    function image() {
        echo ' <div class="item" id="{{item.id}}" >
                <img src="{{models.selected.properties[key].value}}" class="custom_preview_image" alt="" id="image_img" />
                <input  ng-click="uploadImg($event, $index)" class="custom_upload_image_button button" type="button" value="Choose Image" />
                <br><a href="#"  ng-click="removeImg($event)" class="custom_clear_image_button">Remove Image</a>
                <input name="image" type="hidden" class="custom_upload_image" value="1" id="image_ID" ng-model="models.selected.properties[key]" />
            </div>';
    }

}
