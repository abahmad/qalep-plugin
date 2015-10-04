<?php

/*
 * set properties and option for element
 */

namespace Qalep\Classes\Core;

class Element {

    public function __construct() {
        
    }

    public function get_properties() {

        return $this->options;
    }

    /*
     * add properties for element
     * 
     * @param string $key     name of the property ex: border
     * @param string $value   value of the property ex:thin 
     * 
     * @return property data in json format
     */

    public function set_properties($key, $value) {

        //get properties if exist
        $element_option = json_decode($this->options, TRUE);
        $props = $element_option['properties'];
        $props[$key] = $value;
        $element_option['properties'] = $props;
        $ele_json = json_encode($element_option);
        return $ele_json;
    }

    public function view($file_name, $data = array(), $print = true) {
        $file_path = '';
        $content = '';
        if (strpos($file_name, '.')) {
            $parts = explode('.', $file_name);
            $file_name = array_pop($parts);
            foreach ($parts as $dir) {
                $file_path.= $dir . DIRECTORY_SEPARATOR;
            }
        }
        $file = QALEP_DIR_PATH . 'elements' . DIRECTORY_SEPARATOR . $file_name . DIRECTORY_SEPARATOR . 'front_' . $file_name . '.php';
        if (file_exists($file)) {

            !empty($data) ? extract($data) : true;
            ob_start();
            require $file;
            $content .= ob_get_clean();
        }

        if ($content != '') {

            if ($print) {
                echo $content;
            } else {
                return $content;
            }
        }

        return false;
    }

}
