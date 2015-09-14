<?php

namespace Qalep\Classes\Core;

class Controller {

    protected $config;
    //protected $media = array();
    protected $scripts;
    private $views_dir_path;

    public function __construct() {
        $this->loader();
    }

    protected function loader() {

        global $ioc;

        $config = $ioc->get('Qalep\\Classes\\Core\\Config');
        $scripts = $ioc->get('Qalep\\Classes\\Core\\Scripts');

        $this->config = $config;
        $this->views_dir_path = $this->config->get('app', 'config')['views_dir_path'];
        $this->scripts = $scripts;
    }

    protected function view($file_name, $data = array(), $print = true) {
        
        $file_path = '';
        $content = '';
        if (strpos($file_name, '.')) {
            $parts = explode('.', $file_name);
            $file_name = array_pop($parts);
            foreach ($parts as $dir) {
                $file_path.= $dir . DIRECTORY_SEPARATOR;
            }
        }

        if (file_exists($this->views_dir_path . $file_path . $file_name . '.php')) {
            !empty($data) ? extract($data) : true;
            ob_start();
            include $this->views_dir_path . $file_path . $file_name . '.php';
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
