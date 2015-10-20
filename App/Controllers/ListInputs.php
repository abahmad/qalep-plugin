<?php

namespace Qalep\App\Controllers;

class ListInputs {

    static function get_input() {
        // load class liastAllElement
        $folder_path = QALEP_DIR_PATH . 'inputs';
        $props = json_decode(file_get_contents("php://input"));
        $data=$props->properties;
//        var_dump($data);
        $content=array();
        foreach ($data as $key => $val) {
           // var_dump($val);
         // echo "$key => $val\n";
            if (isset($val->input_type)) {
                $input_type = $val->input_type;
                (isset($data->choices)) ? $choises = $data->choices : $choises = array();
                // var_dump($choises);
                /* check if there is a custom input
                 * if not found call defalut function from input class
                 */
                $folders = DI()->get('Qalep\App\Controllers\ListAllElement')->list_folders($folder_path);
                if (!empty($folders)) {
                    foreach ($folders as $folder) {
                        if ($folder == $input_type) {
                            $file_path = $folder_path . '/' . $input_type . '/' . $input_type . '.php';
                            if (file_exists($file_path)) {
                                ob_start();
                                include($file_path);
                               $content[$key] = ob_get_clean();
                            }
                        } else {
                            if (method_exists('Qalep\Core\Input', $input_type)) {
                                $input = \DI()->get('Qalep\App\Controllers\ListInputs');
                                $content[$key] = $input->$input_type($choises);
                            } else {
                               $content[$key] = "input undifend ";
                            }
                            //$cont = '<input type='text'  ng-model='models.selected.properties[key]' />';
                        }
                    }
                } else {
                    $content[$key] = _("no inputs found", 'qlp');
                }
            } else {
                $content[$key] = "<input type='text'  ng-model='models.selected.properties[key]' />";
            }
        }
        echo json_encode($content);
        die();
    }

}
