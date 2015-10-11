<?php

/*
  Element Name: Text
 * Author : M.Anwar <m.anwar@mnbaa.com> 
 */
namespace Qalep\elements\text;
use Qalep\Classes\Core\Element;

class Text extends Element{

    private $options;
    protected $scripts;

    public function __construct() {
        $this->options = '{"label": "Text", "type": "paragraph"}';
    }

    public function get_properties() {

        return $this->options;
    }


    public function draw_template() {

        return '<div class="item" >
            {{item.label}}
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            </div>
            </div>';
    }

    public function draw() {

        $scripts = DI()->get('Qalep\\Classes\\Core\\Scripts');
        $this->scripts = $scripts;
        $scripts->addScript(array('para', asset('elements.paragraph.js', 'para.js')));
        //$this->scripts->run();
        echo "<span>title</span>";
        add_action('wp_enqueue_scripts', array(&$this, 'love'));
        //add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
        // wp_enqueue_script('bootstrap',plugins_url('', __FILE__) .'/js/para.js');
        // wp_enqueue_script('bootstrap',plugins_url('', __FILE__) .'/js/para.js');
    }

}
