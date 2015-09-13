<?php

namespace Qalep\Classes\Core;

class Config {

    private $config_dir_path;
    private $data;
    protected $config;

    public function __construct(Config $config) {
        $this->config = $config;
        $this->config_dir_path = $config->get('app.config', 'config_dir_path') ?: QALEP_DIR_PATH . 'config/';
    }

    public function get($file_name, $key) {
        $file_path = '';
        if (strpos($file_name, '.')) {
            $parts = explode('.', $file_name);
            $file_name = array_pop($parts);
            foreach ($parts as $dir) {
                $file_path.= $dir . DIRECTORY_SEPARATOR;
            }
        }
        if (isset($data[$file_name][$key])) {
            return $this->data[$file_name][$key];
        } else if (file_exists($this->config_dir_path . $file_path . $file_name . '.php')) {
            $config_file = require $this->config_dir_path . $file_path . $file_name . '.php';
            $this->data[$file_name] = $config_file;
            return $this->data[$file_name][$key];
        } else {
            return false;
        }
    }

}
