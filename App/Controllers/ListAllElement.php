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

            if (file_exists($file_path)) {

                //get element name
                $elements_name = get_file_data($file_path, array('elementName' => 'Element Name'));

                //check if element name is typed
                if (!empty($elements_name['elementName'])) {
                    require_once $file_path;
                }

                foreach ($elements_name as $name) {
                    $element_folder = strtolower($name);
                    $element_class = '\qalep\\elements\\' . $element_folder . '\\' . $name;
                    if (class_exists($element_class)) {
                        //creat object from class if exist
                        $obj = DI()->get($element_class);

                        $this->register_element($obj,$name);
                        $this->register_template($obj);
                    }
                }
            }
        }
    }

    public function register_bultin_element() {
        echo "<script>window.qalep_elements.push({label:'Conatiner',type:'container', columns:[[]],properties: {fixed: 'true'}});</script>";
        echo "<script>window.qalep_elements.push({label:'Section',type:'column',properties: {width: '12', offset: '0'}});</script>";
    }

    public function get_registed_shortcodes() {

        $user_shortcode = DI()->get('Qalep\App\Controllers\ShortCode')->get_user_shortcode();
        if (!empty($user_shortcode)) {
            foreach ($user_shortcode as $key => $item) {
                echo "<script>window.qalep_elements.push({label:'$item',type:'shortcode',value:'$item'});</script>";
            }
        }
        //get short codes from namozaghk plugin
        if (is_plugin_active('mnbaa_namozagk/mnbaa_namozagk.php')) {
            if (class_exists('Form')) {
                $form = \DI()->get('Form');
                $forms = $form::find_all();
                foreach ($forms as $form) {
                    $val = "[Mnbaa Namozagk Form ID=$form->id]";
                    echo "<script>window.qalep_elements.push({label:'$val',type:'shortcode',value:'$val'});</script>";
                }
            }
        }
        // meta slider plugin shortcode
        if (is_plugin_active('ml-slider/ml-slider.php')) {
            $args = array(
                'post_type' => 'ml-slider',
                'post_status' => 'publish',
                'order' => 'ASC',
            );
            $slider_shortcodes = get_posts($args);
            foreach ($slider_shortcodes as $slider) {
                $val = "[metaslider id=$slider->ID]";
                echo "<script>window.qalep_elements.push({label:'$val',type:'shortcode',value:'$val'});</script>";
            }
        }
    }

    /* Register element */

    public function register_element($obj,$name) {
        
        $obj->set_option('label',$name);
        $item_options=  $obj-> get_option();
        echo "<script>window.qalep_elements.push($item_options);</script>";
    }

    /* register all  template element */

    public function register_template($obj) {
        //get class name of this object
        $classNameSpace = get_class($obj);
        $path = explode('\\', $classNameSpace);
        $class = array_pop($path);

        $element_content = $obj->draw_template();

        $file_name = strtolower($class) . '.html';
        $content = json_encode($element_content);
        $element = '{key:"' . $file_name . '",content:' . $content . '}';
        echo "<script>window.elements_template.push($element);</script>";
    }

}
