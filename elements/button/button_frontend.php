<?php 
$border=$value->border;
$size=$value->size;
$color=$value->color;
?>
<div class="col-md-2  col-md-offset-0">
    <button  class="btn <?php echo $color->value ; ?>-btn <?php echo $border->value ; ?>-btn <?php echo  $size->value ;?>-btn" ><?php echo trim($value->value);?></button></div>

