<?php
$textalign=$value->textalign;
        ?>
<h3 class="gray <?php echo $textalign->value; ?>"><?php echo $value->title;?></h3>
<div class=""><p class="gray <?php echo $textalign->value; ?>"><?php echo trim($value->text); ?></p></div>