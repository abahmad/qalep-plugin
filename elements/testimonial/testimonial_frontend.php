<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$size = $props->size;
$image = $props->image;
$template = $props->template;
$template_value = $template->value;
$person = $props->personName;
$position = $props->personPosition;
$text = $props->text;
//var_dump($value);
if (!empty($text)) {
    if ($template_value == 'with popup') {
        ?>
        <div class="col-md-3">
            <div class="testmonial-say">
                <p><?php echo $text->value ?></p>
                <div class="col-md-3">
                     <div class="testmonial-say-img">
<?php if ($image->value) { ?>
                            <img src='<?php echo $og_image[0]; ?>' > 
                        <?php } else { ?>  <img src='<?php
                            echo plugin_dir_url(__FILE__);
                            ?>/images/noimage.jpg' > <?php } ?>
</div>
                </div>

                <div class="col-md-9">
                    <h3><?php echo $person; ?></h3>
                    <h5><?php echo $position ?></h5>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div><div class="testmonial-item">

                <?php if (!empty($image->value)) { ?>
                    <div class="testmonial-img"> <img src="<?php echo $og_image[0]; ?>">  </div>
                <?php } ?>
                <h3 class="text-center"><?php echo $person; ?></h3>
                <h5 class="text-center"><?php echo $position; ?></h5>
                <p class="text-center"><?php echo $text->value; ?></p>
            </div>
        </div>
        <?php
    }
}
?>

