<?php
$bg = $props->background;
$bg_color = $bg->value;
$text=$props->text;
$image=$props->image;
//
$text= $props->text;
if(!empty($text)){
?>
<div>
    <div class="alert alert-over alert-dismissible alert-solid <?php echo $bg_color; ?>-back white-font">
        <button class="close solid-close" data-dismiss="alert" type="button"><span>&times;</span></button>
            <img style="float:left" src='<?php echo $image->value; ?>'/>
            <p><?php echo $text->value; ?>
    </div>
</div>
<?php }?>

