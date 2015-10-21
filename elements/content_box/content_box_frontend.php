<?php
$obj = DI()->get('Qalep\App\Controllers\Templater');
$template=$props->template;
$template_id=$template->value;

if($template_id=='box1'){
    ?>
    <div class="col-md-4">
            <div class="content-box">
                <h3> <span class="glyphicon glyphicon-bell"></span><?php echo $props->title; ?></h3>
                <p><?php  echo $obj->qalep_get_value($props,'text'); ?></p>
                <a href="#"> see more </a>
            </div>  
        </div>
<?php 
}
elseif($template_id=='box2'){?>

    <div class="col-md-3">
            <div class="content-center text-center">
             <span class="glyphicon glyphicon-bell"></span>
             <h3><?php echo $props->title; ?></h3>
             <p><?php echo $obj->qalep_get_value($props,'text'); ?></p>
            <a href="#"> see more </a>
            </div>
        </div>
    <?php 
}
else{?>
    <div class="content-rec"> <div class="col-md-6">
                <h3>'<?php echo $props->title; ?></h3>
                    <div class="contxt">
                    <p><?php echo $obj->qalep_get_value($props,'text'); ?></p>
                    <a href="#"> see more </a>
                    </div>
                </div></div>
<?php } ?>
