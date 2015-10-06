<?php
$props=$value->properties;
$bg = $props->background;
$bg_color = $bg->value;
//
$image_id = $props->image;
$og_image = wp_get_attachment_image_src($image_id, 'medium');
$og_image = $og_image[0];
//$content .='
$text= $props->text;
if(!empty($text)){
?>
<div class="col-md-5">
    <div class="alert alert-over alert-dismissible alert-solid <?php echo $bg_color; ?>-back white-font">
        <button class="close solid-close" data-dismiss="alert" type="button"><span>&times;</span></button>
        <?php if ($og_image) { ?>
            <img style="float:left" src='<?php echo $og_image; ?>'/>
        <?php } ?>
            <p><?php echo $obj->qalep_get_value($value, 'text'); ?>
    </div>
</div>
<?php }?>

