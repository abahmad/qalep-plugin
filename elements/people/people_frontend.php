<?php
$value=$props;
$desc=$value->text;
$template=$value->template;
$template_value=$template->value;
$color=$props->background_color;
//print_r($template_value);
$image=$value->image;
$image_src=$image->value;
//
                    
if($template_value == '4'){?>

  <div class="col-md-4"><div class="people-box">
        <div class="people-img pull-left">
       <img src="<?php echo $image_src; ?>"/></div>
           <div class="people-head pull-left">
                        <h3><?php echo $value->name ;?></h3>
                        <h5> <small><?php echo $value->position ?></small> </h5>
                    </div>
                    <div class="content pull-left text-justify"> <p> <?php echo $desc->value; ?></p> </div>
                    <div class="clearfix"> </div>
                    <div class="social-links text-center"><ul>
                            <li><i class="fa fa-facebook-square"></i></li>
                            <li><i class="fa fa-twitter-square"></i></li>
                            <li><i class="fa fa-linkedin-square"></i></li>
                            <li><i class="fa fa-rss-square"></i></li>
                            <li><i class="fa fa-google-plus-square"></i></li>
                            <li><i class="fa fa-pinterest-square"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
 
<?php }
elseif ($template_value == '3') {?>
  <div class="col-md-3">
                <div class="people-clean">
                    <div class="pc-img pull-left"><img src="<?php echo $image_src; ?>" /> </div>
                    <div class="pc-head pull-left">
                        <h3> <?php echo $value->name ;?> </h3>
                        <h5> <small><?php echo $value->position ?></small> </h5>
                    </div>
                    <div class="pc-content pull-left text-justify"> <p> <?php echo $desc->value; ?></p> </div>
                    <div class="clearfix"> </div>
                    <div class="pc-social-links text-center">
                        <ul>
                            <li><i class="fa fa-facebook-square"></i></li>
                            <li><i class="fa fa-twitter-square"></i></li>
                            <li><i class="fa fa-linkedin-square"></i></li>
                            <li><i class="fa fa-rss-square"></i></li>
                            <li><i class="fa fa-google-plus-square"></i></li>
                            <li><i class="fa fa-pinterest-square"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
<?php 
}
elseif ($template_value=="2") {?>
    <div class="col-md-2">
            <div class="people-reqver">
            <div class="people-reqhead">
               <img src="<?php echo $image_src; ?>" />
                <h3><?php echo $value->name;?> </h3>
                <h5><small> <?php echo $value->position ?></small></h5>
            </div>
            <div class="people-reqcontent text-justify"> <p><?php echo $desc->value; ?></p> </div>
                    <div class="preq-links text-center">
                        <ul>
                            <li><i class="fa fa-facebook-square"></i></li>
                            <li><i class="fa fa-twitter-square"></i></li>
                            <li><i class="fa fa-linkedin-square"></i></li>
                            <li><i class="fa fa-rss-square"></i></li>
                            <li><i class="fa fa-google-plus-square"></i></li>
                            <li><i class="fa fa-pinterest-square"></i></li>
                        </ul>
                    </div>
            </div>
        </div>
<?php 
}
 else { ?>
    <div style="background-color:<?php echo $color->value ; ?>">
                <div class="people-full">
                    <div class="people-fullimg pull-left">
                       <img src="<?php echo $image_src; ?>" />
                    </div>
                    <h3><?php echo $value->name;?></h3>
                    <h5><small><?php echo $value->position ?></small></h5>
                    <p><?php echo $desc->value; ?></p>
                        <div class="pf-links">
                            <ul>
                                <li><i class="fa fa-facebook-square"></i></li>
                                <li><i class="fa fa-twitter-square"></i></li>
                                <li><i class="fa fa-linkedin-square"></i></li>
                                <li><i class="fa fa-rss-square"></i></li>
                                <li><i class="fa fa-google-plus-square"></i></li>
                                <li><i class="fa fa-pinterest-square"></i></li>
                            </ul>
                        </div>
                </div>
            </div>

    
<?php } ?>