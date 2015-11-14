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
        <?php ob_start();?><!-- <mnbaa_SEPERATOR> "[\r\n  {\r\n    \"label\": \"post\",\r\n    \"type\": \"post\",\r\n    \"properties\": {\r\n      \"numberposts\": \"1\",\r\n      \"post_type\": {\r\n        \"input_type\": \"select\",\r\n        \"choices\": {\r\n          \"post\": \"post\",\r\n          \"page\": \"page\",\r\n          \"attachment\": \"attachment\",\r\n          \"book\": \"book\",\r\n          \"qalep\": \"qalep\"\r\n        },\r\n        \"value\": \"post\"\r\n      },\r\n      \"post_meta_fileds\": {\r\n        \"input_type\": \"checkbox\",\r\n        \"choices\": {\r\n          \"template_element\": 0,\r\n          \"hodameta\": 1\r\n        },\r\n        \"value\": [\r\n          \"apple\",\r\n          \"pear\",\r\n          0,\r\n          1\r\n        ]\r\n      },\r\n      \"taxnomy\": {\r\n        \"input_type\": \"checkbox\",\r\n        \"choices\": {\r\n          \"tax\": 0\r\n        },\r\n        \"value\": \"\"\r\n      },\r\n      \"pagination\": {\r\n        \"input_type\": \"radio\",\r\n        \"choices\": [\r\n          \"pagination-default\",\r\n          \"pagination-soft\",\r\n          \"pagination-color\",\r\n          \"pagination-cir\"\r\n        ],\r\n        \"value\": \"pagination-default\"\r\n      }\r\n    }\r\n  }\r\n]"</mnbaa_SEPERATOR>--><?php ob_clean();?><?php do_shortcode("[qalep template id=92]"); ?>