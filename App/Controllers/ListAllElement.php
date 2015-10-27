<?php

/*
 * list all registered elements in elements folder
 * 
 */

namespace Qalep\App\Controllers;

class ListAllElement {

    protected $elements_folder;

    public function __construct() {
        
    }

    /*
     * search for all elements in custom folder elements in activated theme
     * and  then serach in defalut elements folder 
     * compare elements and overide custom elements on defalut
     */

    function search_elements() {
        $custom_elements_path = get_template_directory() . "/qalep/elements";
        $defalut_elemnts_path = QALEP_DIR_PATH . 'elements';

        $this->elements_folder = QALEP_DIR_PATH . 'elements';
        $custom_arr = $this->get_element_name($custom_elements_path);
        $defalut_arr = $this->get_element_name($defalut_elemnts_path);
        $arrs = array_intersect_key($custom_arr, $defalut_arr);
        foreach ($arrs as $key => $val) {
            unset($defalut_arr[$key]);
        }
        $all_elements = array_merge($defalut_arr, $custom_arr);
        $this->get_elements($all_elements);
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
    public function get_elements($elements) {
        foreach ($elements as $name => $val) {
            $folder = strtolower($name);
            $file_path = $val . '/' . $folder . '/' . $folder . '.php';
            if (file_exists($file_path)) {
                require_once $file_path;
                //

                $element_class = '\qalep\\elements\\' . $folder . '\\' . $name;
                $obj = DI()->get($element_class);
                // var_dump($obj);

                $this->register_element($obj, $name);
                $this->register_template($obj);
            }
        }
    }

    /*
     * search in speific path folder and list all elements name
     */

    public function get_element_name($path) {
        $element_names = array();
        if (file_exists($path)) {
            $elements_folder = $this->list_folders($path);
            // var_dump($elements_folder);
            //get all files on this folder
            foreach ($elements_folder as $element_folder) {
                $file_path = $this->elements_folder . '/' . $element_folder . '/' . $element_folder . '.php';
                if (file_exists($file_path)) {
                    $name = get_file_data($file_path, array('elementName' => 'Element Name'));
                    $name = $name['elementName'];
                    $element_names[$name] = $path;
                }
            }
        }
        return $element_names;
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

    public function register_element($obj, $name) {

       // $obj->set_option('label', $name);
        $item_options = $obj->get_option();
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
