<?php
$border = $props->border;
$size = $props->size;
$color = $props->color;
?>
<div class="col-md-2  col-md-offset-0">
    <button  class="btn <?php echo $color->value;?>-btn <?php echo $border->value; ?>-btn <?php echo $size->value; ?>-btn" ><?php echo trim($props->value); ?></button></div>

