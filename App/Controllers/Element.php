<?php

class QalepElement {

    public $options;

    public function __construct($type, $label) {
        $this->options = "{type:'.$type.',label:$label}";
        return $this->options;
    }

}
