<?php

namespace Qalep\Classes\Core;

class Shortcode {
    private $registered;
    
    public function add($shortcode) {
        $this->registered[] = (array)$shortcode;
    }
    
    public function get() {
        return $this->registered;
    }
}