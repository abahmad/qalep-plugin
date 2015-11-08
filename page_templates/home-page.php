<?php /*
        * Template Name: home page
        *
        * Description: A page template that provides a key component of WordPress as a CMS
        * by meeting the need for a carefully crafted introductory page. The front page template
        * in Twenty Twelve consists of a page content area for adding text, images, video --
        *
        * @package WordPress
        * @subpackage Twenty Thirteen

        */?>
        <?php ob_start();?><!-- <mnbaa_SEPERATOR> "[\r\n  {\r\n    \"label\": \"Conatiner\",\r\n    \"type\": \"container\",\r\n    \"columns\": [\r\n      [\r\n        {\r\n          \"label\": \"Image\",\r\n          \"type\": \"image\",\r\n          \"imgSrc\": \"http:\/\/localhost\/wordpress\/wp-content\/uploads\/2015\/11\/people1.jpg\"\r\n        }\r\n      ]\r\n    ],\r\n    \"properties\": {\r\n      \"fixed\": {\r\n        \"input_type\": \"radio\",\r\n        \"choices\": {\r\n          \"True\": \"true\",\r\n          \"False\": \"false\"\r\n        },\r\n        \"value\": \"true\"\r\n      }\r\n    }\r\n  }\r\n]"</mnbaa_SEPERATOR>--><?php ob_clean();?><?php do_shortcode("[qalep template id=92]"); ?>