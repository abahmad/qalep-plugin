<?php
$value = $props;
$percent = $value->percent;
$size = $value->size;
$borderWidth = $value->borderWidth;
$bgFill = $value->bgFill;
$frFill = $value->frFill;
$textSize = $value->textSize;
$textColor = $value->textColor;
?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<div class="col-md-4 col-md-offset-3">
    <div id="diagram-id-12"class="diagram" data-circle-diagram='{
         "percent": "<?php echo $percent; ?>",
         "size": "<?php echo $size; ?>",
         "borderWidth": "<?php echo $borderWidth; ?>",
         "bgFill": "<?php echo $bgFill; ?>",
         "frFill": "<?php echo $frFill; ?>",
         "textSize": "<?php echo $textSize; ?>",
         "textColor": "<?php echo $textColor; ?>"
         }'>
    </div>         
</div>
<?php $dir = plugin_dir_url(__FILE__); ?>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="<?php echo $dir . '/js/jquery.circle-diagram.js' ?> "></script>
<script src= <?php echo $dir . 'js/main.js' ?> ></script>
