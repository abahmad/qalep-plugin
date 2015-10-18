<?php

$data = json_decode(file_get_contents("php://input"));
var_dump($data->input_type);
//require_once 'http://localhost/wordpress/wp-content/plugins/qalep/inputs/'.$data->val.'.php';

?>


