<?php

$page_id = $_GET['page_id'];
$page_data = get_page($page_id);
$content = $page_data->post_content;
?>

