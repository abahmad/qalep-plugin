 <?php 
 $value=$value->properties;
 $percent=$value->percent;
 $size=$value->size;
 $borderWidth=$value->borderWidth;
 $bgFill=$value->bgFill;
 $frFill=$value->frFill;
 $textSize=$value->textSize;
 $textColor=$value->textColor;

 
 
//$content .= <<<EOD
 ?>
<div class="col-md-4 col-md-offset-3">
                     <div id="diagram-id-12"class="diagram" data-circle-diagram='{
                        "percent": "<?php echo $percent; ?>",
                        "size": "<?php echo $size; ?>",
                        "borderWidth": "<?php echo $borderWidth; ?>",
                        "bgFill": "<?php echo $bgFill; ?>",
                        "frFill": "<?php  echo $frFill ;?>",
                        "textSize": "<?php  echo $textSize ;?>",
                        "textColor": "<?php  echo $textColor ;?>"
                        }'>
                    </div>         
    </div>