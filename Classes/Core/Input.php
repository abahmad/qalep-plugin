<?php

/*
 * To add inputs
 */
namespace Qalep\Classes\Core;

class Input {

    function label($text = '', $for = '') {
        echo '<label for="' . $for . '_ID">' . $text . '</label>';
    }
    
    function input($label,$field, $value = ''){
        echo '<span>'.$label.'</span><input ng-model="'.$value.'" type="'.$field.'" value="'.$value.'"/>';
    }
//    function input($field,$type, $value = '') {
//        echo '<input type="'.$type.'" name="' . $field . '" id="' . $field . '_ID" value="' . $value . '" size="40" />';
//    }

    function textarea($field, $value = '') {
        echo '<textarea name="' . $field . '" id="' . $field . '_ID" cols="60" rows="4">' . $value . '</textarea>';
    }

    function img_input($field, $post_seo_meta = '') {
        $og_image = plugins_url('mnbaa_seo/images', '') . '/noimage.jpg';
        if ($post_seo_meta) {
            $og_image = wp_get_attachment_image_src($post_seo_meta, 'medium');
            $og_image = $og_image[0];
        }
        echo '<input name="' . $field['name'] . '" type="hidden" class="custom_upload_image" value="' . $post_seo_meta . '" />
		<img src="' . $og_image . '" class="custom_preview_image" alt="" /><br />
		<input class="custom_upload_image_button button" type="button" value="Choose Image" />
		<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small><br clear="all" />
		<span class="description">' . $field['desc'] . '</span><br />';
    }

    function select($field = '', $option = array(), $value = '') {
        echo '<select name="' . $field . '" id="' . $field . '_ID">';
        foreach ($options as $option) {
            echo '<option', $value == $option ? ' selected="selected"' : '', ' value="' . $option . '">' . $option . '</option>';
        }
        echo '</select>';
    }

// function to make multi select control
    function multi_select($field = '', $post_seo_meta = '') {
        echo '<select name="' . $field['name'] . '" id="' . $field['name'] . '_ID" multiple>';
        foreach ($field['options'] as $option) {
            echo '<option', $post_seo_meta == $option ? ' selected="selected"' : '', ' value="' . $option . '">' . $option . '</option>';
        }
        echo '</select><br /><span class="description">' . $field['desc'] . '</span><br />';
    }

    

}
