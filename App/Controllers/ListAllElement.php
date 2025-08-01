<?php

/**
 * list all registered elements in elements folder
 * @package Qalep\App\Controllers
 */

namespace Qalep\App\Controllers;

class ListAllElement {

    protected $elements_folder;

    public function __construct() {
        
    }

    /**
     * search for all elements in custom folder elements in activated theme
     * and  then serach in defalut elements folder 
     * compare elements and overide custom elements on defalut
     * return array key is element name and the vlaue is path where is element
     */
    function search_elements() {
        $custom_elements_path = get_template_directory() . "/qalep/elements";
        $defalut_elemnts_path = QALEP_DIR_PATH . 'elements';

        $last_sign = get_option('qalep_elements_sign');

        $sign = '';
        if (file_exists($defalut_elemnts_path) || file_exists($custom_elements_path)) {

            if ($defalut_elemnts_path)
                $sign .= filemtime($defalut_elemnts_path);
            if (isset($custom_elements_path_elemnts_path))
                $sign .= filemtime($custom_elements_path);
        }

        if ($last_sign == $sign) {
            $this->get_elements(get_option('qalep_elements_index'));
        } else {
            $this->elements_folder = QALEP_DIR_PATH . 'elements';
            $custom_arr = $this->get_element_name($custom_elements_path);
            $defalut_arr = $this->get_element_name($defalut_elemnts_path);
            $arrs = array_intersect_key($custom_arr, $defalut_arr);
            foreach ($arrs as $key => $val) {
                unset($defalut_arr[$key]);
            }
            $all_elements = array_merge($defalut_arr, $custom_arr);
            update_option('qalep_elements_index', $all_elements);
            update_option('qalep_elements_sign', $sign);
            $this->get_elements($all_elements);
        }
    }

    /*
     * list all elements folders on basic elements folder
     * @param string folder  folder name
     * @return array elements_folders 
     */

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
        return $elements_folder;
    }

    public function register_shortcodes() {
        $theme_sc = get_template_directory() . "/qalep/shortcodes";
        $plugin_sc = QALEP_DIR_PATH . 'shortcodes';



        if (file_exists($theme_sc)) {
            $tsca = array_slice(scandir($theme_sc), 2);
            $tsc = array_map(function($v) use ($theme_sc) {
                return $theme_sc . '/' . $v;
            }, $tsca);
        }

        if (file_exists($plugin_sc)) {
            $psca = array_slice(scandir($plugin_sc), 2);

            foreach ($psca as $k => $v) {

                if (isset($tsca)) {

                    if (in_array($v, $tsca)) {
                        unset($psca[$k]);
                    }
                }
            }

            $psc = array_map(function($v) use ($plugin_sc) {
                return $plugin_sc . '/' . $v;
            }, $psca);
        }

        if (isset($tsc) && isset($psc)) {
            $shortcodes = array_merge($psc, $tsc);
        } else {
            $shortcodes = $psc;
        }
        foreach ($shortcodes as $shortcode) {
            $sc_file = include $shortcode;
            if (!empty($sc_file) && is_array($sc_file)) {
                DI()->get('Qalep\Classes\Core\Shortcode')->add($sc_file);
            }
        }
    }

    /**
     * Retrieve elements name from a file.
     * Searches in elements folder for elements
     * @param array elements
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

                $this->register_element($obj);
                $this->register_template($obj);
            }
        }
    }

    /**
     * search in speific path folder and list all elements name
     * @param string path  abslout path of this element
     * @return array names of elements
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

    /**
     * draw template cash for shoretcod element
     */
    public function get_registed_shortcodes() {

        $user_shortcode = DI()->get('Qalep\App\Controllers\ShortCode')->get_user_shortcode();
        if (!empty($user_shortcode)) {
            foreach ($user_shortcode as $key => $item) {
                echo "<script>window.qalep_elements.push({label:'$item',type:'shortcode',value:'$item'});</script>";
            }
        }

        //Looking UP Shortcodes
        $this->register_shortcodes();
        // Fetching custom shortcodes
        $shortcodes = DI()->get('Qalep\Classes\Core\Shortcode')->get();

        if (!empty($shortcodes) && is_array($shortcodes)) {
            foreach ($shortcodes as $registered_shortcode_array) {
                foreach ($registered_shortcode_array as $shortcode_name => $shortcode_params) {
                    echo "<script>window.qalep_elements.push(" . json_encode($shortcode_params) . ");</script>";
                }
            }
        }

        //get short codes from namozaghk plugin
        /* if (is_plugin_active('mnbaa_namozagk/mnbaa_namozagk.php')) {
          if (class_exists('Form')) {
          $form = \DI()->get('Form');
          $forms = $form::find_all();
          foreach ($forms as $form) {
          $val = "[Mnbaa Namozagk Form ID=$form->id]";
          echo "<script>window.qalep_elements.push({label:'$val',type:'shortcode',value:'$val'});</script>";
          }
          }
          }

          //get short codes from woocommerce plugin
          if (is_plugin_active('woocommerce/woocommerce.php')) {
          $wooCart = array(
          'label' => __('WooCommerce Cart', 'qalep'),
          'type' => 'shortcode',
          'shortcode_base' => 'woocommerce_cart'
          );
          $wooCheckout = array(
          'label' => __('WooCommerce Checkout', 'qalep'),
          'type' => 'shortcode',
          'shortcode_base' => 'woocommerce_checkout'
          );
          $wooOrderTracking = array(
          'label' => __('WooCommerce Order Tracking', 'qalep'),
          'type' => 'shortcode',
          'shortcode_base' => 'woocommerce_order_tracking'
          );
          $wooMyAccount = array(
          'label' => __('WooCommerce My Account', 'qalep'),
          'type' => 'shortcode',
          'shortcode_base' => 'woocommerce_my_account',
          "properties" => array(
          __("order_count", 'qalep') => array(
          "input_type" => "number",
          "value" => 15
          )
          )
          );
          echo "<script>window.qalep_elements.push(" . json_encode($wooCart) . ");</script>";
          echo "<script>window.qalep_elements.push(" . json_encode($wooCheckout) . ");</script>";
          echo "<script>window.qalep_elements.push(" . json_encode($wooOrderTracking) . ");</script>";
          echo "<script>window.qalep_elements.push(" . json_encode($wooMyAccount) . ");</script>";
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
          } */
    }

    /**
     *  Register element
     * @param object obj object of element to be registred
     */
    public function register_element($obj) {

        $item_options = $obj->get_option();
        echo "<script>window.qalep_elements.push($item_options);</script>";
    }

    /**
     * register all  template element 
     * @param object obj object of element to be registred
     */
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
