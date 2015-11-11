<?php
$text = $props->text;
$title = $props->title;
$alignment = $props->textalign;
$alignment_value = $alignment->value;
$quotes = $props->quotes;
?>
<h3 class="gray text-center"><?php echo $title ?></h3>
<div >
    <p class="gray <?php if (($quotes->value)) echo " quotes ";
echo $alignment_value; ?>"><?php echo $text->value; ?></p>
</div>
