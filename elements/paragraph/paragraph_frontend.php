<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $title =$props->title;
$border = $props->Border;
// $template =$value->template;
// $template_value=$template->value;
$alignment = $props->Alignment;
$alignment_value = $alignment->value;
?>
<h2 class="<?php echo $alignment_value . ' ' . $border->value; ?>-bordered-title"><span><?php echo $title; ?></span></h2>
