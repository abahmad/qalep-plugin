<?php

/*
 * list all registered elements in elements folder
 * 
 */

namespace Qalep\App\Controllers;

class ListAllElement {

    protected $elements_folder;

    public function __construct() {
        $this->elements_folder = QALEP_DIR_PATH . 'elements';
    }

    //list all elements folders on basic elements folder
    public function list_folders($folder) {
        $blocks = scandir($folder);
        //remove root elements ., ../ from folder
        $blocks_folder_content = array_slice($blocks, 2);
        $elements_folder = array();
        //get only folder from qalep_blocks folder
        foreach ($blocks_folder_content as $item) {
            $pos = strpos($item, '.');
            if ($pos === false) {
                $elements_folder[] = $item;
            }
        }
        return($elements_folder);
    }

    /**
     * Retrieve elements name from a file.
     * Searches in elements folder for elements
     */
    public function get_elements() {
        $elements_folder = $this->list_folders($this->elements_folder);
        //get all files on this folder
        foreach ($elements_folder as $element_folder) {
            $file_path = $this->elements_folder . '/' . $element_folder . '/' . $element_folder . '.php';
           //echo  $file_path;
           
            require_once $file_path;
            $elements_name = get_file_data($file_path, array('elementName' => 'Element Name'));
            foreach ($elements_name as $name) {
                $element_folder = strtolower($name);
                $element_class = '\qalep\\elements\\' . $element_folder . '\\' . $name;
                
                
                if (class_exists($element_class)) {
                    //creat object from class if exist
                    $obj=  DI()->get($element_class);
                    
                    $this->register_element($obj);
                    $this->register_template($name, $obj);
                }
            }
            // return $elements;
            //return $data['elementName'];
            //
//            if (file_exists($file_path)) {
//                //include class for this element
//                require_once $file_path;
//                $lines = file($file_path);
//                foreach ($lines as $line) {
//                    if (strpos($line, 'Element Name')) {
//                        $pattern = explode(':', $line);
//                        $class = trim($pattern [1]);
//                        $element_folder = strtolower($class);
//                        $element_class = '\Qalep\Elements\\' . $element_folder . '\\' . $class ;
//
//                        $this->register_element($element_class);
//                        $this->register_template($class,$element_class);
//                    }
//                }
//            }
        }
    }

    /* Register element */

    public function register_element($obj) {
        $item_options = $obj->get_properties();
        echo "<script>window.qalep_elements.push($item_options);</script>";
    }

    /* register all  template element */

    public function register_template($class, $obj) {

        $element_content = $obj->draw_template();

        $file_name = strtolower($class) . '.html';
        $content = json_encode($element_content);
        $element = '{key:"' . $file_name . '",content:' . $content . '}';
        echo "<script>window.elements_template.push($element);</script>";
    }


}
