<?php

function asset0($file_name, $ext = '') {
    $file_path = '';
    //echo $file_name;die;
    if (strpos($file_name, '.')) {
        $parts = explode('.', $file_name);
        $file_name = array_pop($parts);
        foreach ($parts as $dir) {
            $file_path.= $dir . DIRECTORY_SEPARATOR;
        }
    }
    return plugins_url($file_path . $file_name . '.' . $ext, dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . QALEP_PLUGIN_NAME . '.php');
}

function asset($base_file_path,$file_name) {
    
    $ext =pathinfo($file_name);
    $ext=$ext['extension'];
    $file_path = '';
    if (strpos($base_file_path, '.')) {
        $parts = explode('.', $base_file_path);
        foreach ($parts as $dir) {
            $file_path.= $dir . DIRECTORY_SEPARATOR;
        }
    }
   return plugins_url($file_path . DIRECTORY_SEPARATOR .$file_name , dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . QALEP_PLUGIN_NAME . '.php');
}
