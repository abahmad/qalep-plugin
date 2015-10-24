<?php

/*
  class to draw  elements on page template front end
 */

namespace Qalep\App\Controllers;

use Qalep\elements;

class FrontQalepDrawer {

    public function __construct($items) {
//        echo"<pre>";
//        print_r($items);
//        echo "<pre>";
        echo get_header();
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->draw($item);
            }
        }
        echo get_footer();
    }

    protected function beforeConatiner($item) {
        return '<div class="row"><div class="container">';
    }

    protected function containerAfter($item) {
        if ($item->type == 'container')
            return '</div></div>';
        elseif ($item->type == 'column')
            return '</div>';
    }

    public function draw($item) {

        if (isset($item->type)) {
            $type = $item->type;
        }
        if ($type) {
            switch ($type) {
                case 'image' :
                    if (isset($item->imgSrc)) {
//                        $og_image = wp_get_attachment_image_src($item->imgID, 'medium');
//                        $og_image = $og_image[0];
                        echo'<img src="' . $item->imgSrc . '" class="custom_preview_image" alt="" id="image_img' . '" />';
                    }

                    break;


                case 'shortcode' :
                    echo do_shortcode($item->value);
                    break;

                case 'container' :

                    echo $this->beforeConatiner($item);
//                     echo "<pre>";
//                        print_r($item);
//                        echo "</pre>";
                    // echo "-----------------------------";
                    foreach ($item->columns as $contained_item) {
                        foreach ($contained_item as $smItem) {
                            //var_dump($smItem);
                            echo $this->draw($smItem);
                        }
                    }
                    echo $this->containerAfter($item);
                    break;

                case 'column' :
                    $props = $item->properties;

                    echo '<div class="col-md-' . $props->width . ' col-md-offset-' . $props->offset . '">';
                    foreach ($item->columns as $contained_item) {
                        //  var_dump($contained_item);
                        foreach ($contained_item as $smItem) {
//                            echo "<pre>";
//                            print_r($smItem);
//                            echo "<pre>";
                            echo $this->draw($smItem);
                        }
                    }
                    echo "</div>";
                    break;

                default:
                    $class_name = 'Qalep\\elements\\' . $type . '\\' . $type;
                    if (class_exists($class_name)) {
                        $obj = DI()->get('Qalep\\elements\\' . $type . '\\' . $type);
                        //if(isse)
                        isset($item->properties) ? $prop = $item->properties : $prop = array();
                        $obj->view($type, array("props" => $prop));
                    }
            }
        }
    }

}
