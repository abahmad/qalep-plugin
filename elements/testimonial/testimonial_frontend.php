<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$props=$value->properties;
$size=$props->size;
$image_id = $props->image;
$og_image = wp_get_attachment_image_src($image_id, 'medium');
$template = $props->template;
$template_value = $template->value;
$person=$props->personName;
$postion=$props->personPosition;
$text = $props->text;
//var_dump($value);
if (!empty($text)) {
    if ($template_value == 'with popup') {
        ?>

        <div class="row">
            <div class="col-md-3">
                <div class="testmonial-say">
                    <p><?php echo $obj->qalep_get_value($value, 'text'); ?></p>
                    <div class="col-md-3">
                        <div class="testmonial-say-img">
                            <?php if ($og_image[0]) { ?>
                                <img src='<?php echo $og_image[0]; ?>' > 
                            <?php } else { ?>  <img src='<?php echo

                    plugin_dir_url(__FILE__);
                                ?>../images/noimage.jpg' ><?php } ?>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <h3><?php echo $obj->qalep_get_value($value, 'personName'); ?></h3>
                        <h5><?php echo $obj->qalep_get_value($value, 'personPosition'); ?></h5>
                    </div>
                </div>
            </div></div>
        <?php
    } else {
        ?>
        <div class="col-md-<?php echo $size->value;?>"><div class="testmonial-item">

                <div class="testmonial-img"> <img src="<?php echo $og_image[0]; ?>">  </div>
                <h3 class="text-center"><?php echo $person ;?></h3>
                <h5 class="text-center"><?php echo $postion ;?></h5>
                <p class="text-center"><?php  echo $text ;?></p>
            </div>
        </div>
        <?php
    }
}
?>

