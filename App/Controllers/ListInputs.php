<?php

/**
 * call all inputs type  defalut and custom inputs
 * @package Qalep\App\Controllers
 */

namespace Qalep\App\Controllers;

class ListInputs {
    
    public function __construct() {
        
    }

    /**
     * function called by ajax
     * draw  all inputs from folder inputs
     * return all inputs in json format to 
     */
    static function get_input() {
        $folder_path = QALEP_DIR_PATH . 'inputs';
        $props = json_decode(file_get_contents("php://input"));
        $data = $props->properties;
        $content = array();
        foreach ($data as $key => $val) {
            if (isset($val->input_type)) {
                $input_type = $val->input_type;
                (isset($val->choices)) ? $choises = $val->choices : $choises = array();

                $file_path = $folder_path . '/' . $input_type . '/' . $input_type . '.php';
                if (file_exists($file_path)) {
//                    ob_start();
                    $input = \DI()->get('Qalep\inputs\\'.$input_type.'\\'.$input_type);
                    $content[$key]=$input->draw();
                    //include($file_path);
                   // $content[$key] = ob_get_clean();
                } elseif (method_exists('Qalep\Classes\Core\Input', $input_type)) {
                    $input = \DI()->get('Qalep\Classes\Core\Input');
                    $content[$key] = $input->$input_type();
                } else {
                    $content[$key] = "input undfiend";
                }
            } else {
                $content[$key] = "<input type='text'  ng-model='models.selected.properties[key]' />";
            }
        }
        echo json_encode($content);
        die();
    }

}
