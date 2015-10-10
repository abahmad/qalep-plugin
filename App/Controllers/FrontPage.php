<?php

namespace Qalep\App\Controllers;

use Qalep\Classes\Core\Controller;


class FrontPage extends Controller {

    public function __construct() {
        parent::__construct();
//        $this->scripts->addAdminStyle(array('qalep-bootstrap', asset('assets.css.qalep-bootstrap', 'css')));
//        $this->scripts->addAdminScript(array('bootstrap-js', asset('bower_components.bootstrap-css.js.bootstrap.min', 'js'), false, false, true));
//        $this->scripts->addAdminScript(array('angularjs', asset('assets.js.angular-min', 'js'), false, false, true));
//        $this->scripts->addAdminScript(array('angular-drag-and-drop-lists', asset('assets.js.angular-drag-and-drop-lists.min', 'js'), false, false, true));
//
//        $this->scripts->run();
    }

    public function _add_admin_menu_page() {

        add_action('admin_menu', function() {
           
            \add_menu_page(__('Qalep Page', 'qlp'), __('Qalep Page', 'qlp'), 'manage_options', 'qalep_menu', array(&$this, 'index'));
        });
    }

    public function index() {
        $this->view('builder', array('title' => 'Template Builder'));
    }

}
