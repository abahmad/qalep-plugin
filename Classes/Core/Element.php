<?php

/**
 * The class to register, update and display element
 *
 * It provides an easy API for people to add their own blocks
 * to the qalep plugin
 *
 * @package Qalep\Classes\Core
 */

namespace Qalep\Classes\Core;

class Element {

    private $options = array();

    public function __construct($options) {

        $this->options = $options;
    }

   


    /**
     * add properties for element
     * 
     * @param string key     name of the property ex: border
     * @param string value   value of the property ex:thin 
     * 
     * @return property data in json format
     */

    public function set_properties($key = '', $value = '') {

        $options = $this->options;
        $props = $options['properties'];
        if (!empty($key) && !empty($value)) {
            $props[$key] = $value;
            $options['properties'] = $props;
        }
        $ele_json = json_encode($options);
        $this->options['properties']=$props;
    }

    public function set_option($key, $value) {
        $this->options[$key]=$value;
      //  array_push($this->options, $key, $value);
        
        
    }
    public function get_option(){
        return json_encode($this->options);
    }
    
/**
 * call html view file
 * @param string file_name 
 * @param array data data will be filled in view file
 * @param bolean  $print 
 */
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
        $front_file=$file_name.'_frontend.php';
        $file = QALEP_DIR_PATH . 'elements' . DIRECTORY_SEPARATOR . $file_name . DIRECTORY_SEPARATOR .$front_file;
        if (file_exists($file)) {
            !empty($data) ? extract($data) : true;
            ob_start();
            require $file;
            $content .= ob_get_clean();
        }else echo _e($front_file. ' is not exist');

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
