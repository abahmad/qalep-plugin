<?php

namespace Qalep\Classes\Core;

class Scripts {

    private $scripts;
    private $styles;

    public function __construct() {
        $this->scripts['frontend'] = array();
        $this->scripts['backend'] = array();
        $this->styles['frontend'] = array();
        $this->styles['backend'] = array();
    }

    public function addScript($script) {
        $this->scripts['frontend'][] = $script;
    }

    public function addStyle($style) {
        $this->styles['frontend'][] = $style;
    }

    public function addAdminScript($script) {
        $this->scripts['backend'][] = $script;
    }

    public function addAdminStyle($style) {
        $this->styles['backend'][] = $style;
    }

    public function admin_enqueue_scripts() {
        foreach ($this->styles['backend'] as $style) {
            call_user_func_array('wp_enqueue_script', $style);
        }
        foreach ($this->scripts['backend'] as $script) {
            call_user_func_array('wp_enqueue_script', $script);
        }
    }

    public function wp_enqueue_scripts() {
        foreach ($this->styles['frontend'] as $style) {
            call_user_func_array('wp_enqueue_script', $style);
        }
        foreach ($this->scripts['frontend'] as $script) {
            call_user_func_array('wp_enqueue_script', $script);
        }
    }

    public function reset() {
        $this->scripts['frontend'] = array();
        $this->scripts['backend'] = array();
        $this->styles['frontend'] = array();
        $this->styles['backend'] = array();

        return true;
    }

    public function run() {
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'));
    }

    public function __destruct() {
        $this->reset();
    }

}
