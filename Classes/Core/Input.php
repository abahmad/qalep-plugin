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
        $result .= '<label ng-repeat="fruitName in models.selected.properties[key].choices">
  <input
    type="checkbox"
    name="selectedFruits[]"
    value="{{fruitName}}"
    ng-checked="models.selected.properties[key].value.indexOf(fruitName) > -1"
    ng-click="toggleSelection(fruitName)"
  > {{fruitName}}
</label>';
        //foreach ($choises as $key => $val) {
        //    $result.= '<input type="checkbox" ng-click="push_item('.$key.')"  value="'.$val.'" /><span>' . $key . ' </span>';
//        $result.='<label ng-repeat="role in roles"><input type="checkbox"  ng-checked="user.roles.indexOf(fruitName) > -1"  checklist-model="user.roles" checklist-value="role" > {{role}}</label>';
        //  }
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

    function select($choises) {
        $str = '<select><option>' . __('Select Choice', 'qalep') . '</option>';
        foreach ($choises as $key => $val) {
            $str.='<option value=' . $val . '>' . $key . '</option>';
        }
        $str.='</select>';
        return $str;
    }

}
