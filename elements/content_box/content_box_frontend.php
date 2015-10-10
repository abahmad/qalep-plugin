<?php
$obj = new QalepTemplater();
$prop=$value->properties;
$template=$prop->template;
$template_id=$template->value;

if($template_id=='box1'){
    ?>
    <div class="col-md-4">
            <div class="content-box">
                <h3> <span class="glyphicon glyphicon-bell"></span><?php echo $obj->qalep_get_value($value,'title'); ?></h3>
                <p><?php  echo $obj->qalep_get_value($value,'text'); ?></p>
                <a href="#"> see more </a>
            </div>  
        </div>
<?php 
}
elseif($template_id=='box2'){?>

    <div class="col-md-3">
            <div class="content-center text-center">
             <span class="glyphicon glyphicon-bell"></span>
             <h3><?php $obj->qalep_get_value($value,'title'); ?></h3>
             <p><?php $obj->qalep_get_value($value,'text'); ?></p>
            <a href="#"> see more </a>
            </div>
        </div>
    <?php 
}
else{?>
    <div class="content-rec"> <div class="col-md-6">
                <h3>'<?php $obj->qalep_get_value($value,'title'); ?></h3>
                    <div class="contxt">
                    <p><?php $obj->qalep_get_value($value,'text'); ?></p>
                    <a href="#"> see more </a>
                    </div>
                </div></div>
<?php } ?>
