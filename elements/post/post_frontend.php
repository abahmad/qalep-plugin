<?php
if (!function_exists('mnbaa_paging_nav')) :

    /**
     * Display navigation to next/previous set of posts when applicable.
     *
     * @since Twenty Fourteen 1.0
     */
    function mnbaa_paging_nav() {
        $total = $GLOBALS['wp_query']->max_num_pages;
        // Don't print empty markup if there's only one page.
        if ($total < 1) {
            return;
        }

        $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $pagenum_link);

        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';

        $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links(array(
            'base' => $pagenum_link,
            'format' => $format,
            'total' => $total,
            'current' => $paged,
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $query_args),
            'prev_text' => __('«', 'qalep'),
            'next_text' => __('»', 'qalep'),
        ));
        return $links;
    }

endif;

// get number of views
function wpb_get_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

global $wp_query;
$numberposts = $props->numberposts;


//echo $numberposts; 
$args = array(
    'post_type' => $props->post_type,
    'posts_per_page' => $numberposts,
    'post_status' => 'publish',
);

$args['paged'] = get_query_var('paged') ? get_query_var('paged') : 1;
$loop = new WP_Query($args);
echo "<div class='db-break'> </div> <div class='row'>";
while ($loop->have_posts()) : $loop->the_post();


    $post_id = get_the_ID();
    ($numberposts > 4) ? $num_col = 3 : $num_col = 12 / $numberposts;
    // echo $num_col ;
    //get just url of image without style
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
    $comments_count = wp_count_comments();
    //content for post
   $words = explode(" ", strip_tags(get_the_content()));
  // $content = implode(" ", array_splice($words, 0, 40));
    //
    ?>
    <div class="col-md-<?php echo $num_col; ?>">
        <div class="full-post">
            <h4><?php echo the_title(); ?></h4>
            <p><?php _e('POSTED BY:', 'qalep'); ?> <small class="post-orange-color"><?php the_author_posts_link(); ?> </small> </p>
    <?php if ($thumbnail[0]) { ?><div class="tumb-post"><img src ="<?php echo $thumbnail[0]; ?>" /></div> <?php } ?>
            <ul>

                <li><?php echo the_date('F j, Y'); ?></li>
                <li> <span class="glyphicon glyphicon-comment"></span><?php echo $comments_count->total_comments; ?> COMMENT</li>
                <!--<li> <span class="glyphicon glyphicon-eye-open"></span><?php echo wpb_get_post_views($post_id); ?> VIEW</li>-->
            </ul>

            <div class="post-content"> 
                <p class="text-justify"><?php echo implode(" ", array_splice($words, 0, 40)); ?> 
                    <a href="<?php echo get_permalink($post_id); ?>" class="blue-link"> [Read more ...] </a>
                </p>
            </div>
        </div>
    </div>
    <?php
endwhile;
//echo "</div>";
echo "</div>";
$temp_query = $wp_query;
$wp_query = NULL;
$wp_query = $loop;

// Reset postdata
wp_reset_postdata();
$links = mnbaa_paging_nav();
// Custom query loop pagination
//echo $wp_query->max_num_pages;
if ($wp_query->max_num_pages > 1)
    $pagination_style = $value->pagination;
//var_dump($pagination_style);
if ($links) :
    ?>

    <nav>
        <div class="text-center">
            <ul class="<?php echo $pagination_style->value; ?>">
                <li>
                    <!--      <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>-->
                </li>
                <li><?php echo $links; ?></li>
                <li>
                    <!--      <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>-->
                </li>
            </ul>
        </div>
    </nav>

    <?php
endif;

// Reset main query object
//$wp_query = NULL;
//$wp_query = $temp_query;
?>
