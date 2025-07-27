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

    function number() {
        return "<input type='number'  ng-model='models.selected.properties[key].value' />";
    }

    public function radio() {
        $result = '';
        $result.= '<label ng-repeat="(itemName,val) in models.selected.properties[key].choices"><input type="radio" value ="{{val}}"  ng-model="models.selected.properties[key].value"> <span>{{itemName}}</span>'
                . '</label>';
        return $result;
    }

    public function checkbox() {
        
        $result='';
        $result .= '<label  ng-repeat="(itemName,val) in models.selected.properties[key].choices">
        <input type="checkbox"  value="{{itemName}}" ng-checked="models.selected.properties[key].value.indexOf(itemName) > -1" ng-click="toggleSelection(itemName,key)"> {{itemName}}
        </label>';


        return $result;
    }

    function custom_checkboox() {
        $result = '';
        $result .= '<div  ng-repeat="(itemName,val) in models.selected.properties[key].choices" class="qalep-item{{itemName}}" style="display:none;">
       <label ng-repeat="(metaKey,metaVal) in models.selected.properties[key].choices[itemName]"> <input type="checkbox"  value="{{metaVal}}" ng-checked="models.selected.properties[key].value.indexOf(metaKey) > -1" ng-click="toggleSelection(metaKey,key)"> {{metaKey}}</label> </div>';
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


    function selectcustom() {
        //
        $str = '<select 
                ng-init = "__model = models.selected.properties[key];" ng-change="showResult(__model.value)"
               ng-model="__model.value"
               ng-options="item as item for item  in __model.choices" 
 >';
        // $str.='<option ng-selected="__model.value" ng-repeat="(itemName,val) in __model.choices" value="{{val}}">{{itemName}}</option>';
        $str.='</select>';
        return $str;
        die();
        
    }
    function select() {
        //
        $str = '<select 
                ng-init = "__model = models.selected.properties[key];" ng-change="showResult(__model.value)"
               ng-model="__model.value"
               ng-options="choice.value as choice.label for choice in __model.choices" 
 >';
        // $str.='<option ng-selected="__model.value" ng-repeat="(itemName,val) in __model.choices" value="{{val}}">{{itemName}}</option>';
        $str.='</select>';
        return $str;
    }
}
