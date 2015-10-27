<?php

namespace Qalep\App\Controllers;

use Qalep\Classes\Core\Controller;

class ShortCode extends Controller {

    public function __construct() {
        parent::__construct();
        add_action('media_buttons_context', array(&$this, 'add_shortcode_button'));
        add_action('admin_footer', array(&$this, 'add_inline_popup_content'));
        
    }

    public function add_shortcode_button($context) {
        $img = plugins_url() . '/qalep/assets/images/penguin.png';

        //our popup's title
        $title = 'An Inline Popup!';

        //append the icon
        $context .= "<a title='{$title}' href='#TB_inline?width=400&inlineId=popup_container'
            class='thickbox' title='Inline Popup' >
      <img src='{$img}' style='width:30px;height:30px;' /></a>";

        return $context;
    }

    //
    public function add_inline_popup_content() {

        $type = "qalep";
        $args = array(
            'post_type' => $type,
            'posts_per_page' => 1,
            'post_status' => 'publish',
            'order' => 'ASC',
            'orderby' => 'title',
        );
        $qalep_shortcodes = get_posts($args);
        ?>
        <div id="popup_container" style="display:none;">
            <h2>Choose your template</h2>
            <div><select id="qalep_templates">
                    <?php
                    foreach ($qalep_shortcodes as $item) {
                        echo "<option value='" . absint($item->ID) . "'>" . esc_attr($item->post_title) . "</option>";
                    }
                    ?>
                </select>
                <input type="button" id= "qalep-inert-shortcode" class="button-primary" value="<?php echo esc_attr__('Insert Template', 'qalep'); ?>"  />
                <a  class="button-secondary" onclick="tb_remove();" title="<?php echo esc_attr__('Cancel', 'qalep'); ?>"><?php echo esc_attr__('Cancel', 'aqpb-l10n'); ?></a>

            </div>
        </div>
        <?php
    }

    //draw shortcode template
    static public function draw_qalep_template($atts) {
        $qalep_templates = get_post_meta($atts['id']);
        $template = $qalep_templates['template_element'];
        $items = json_decode($template[0]);
        $template_content = new FrontQalepDrawer($items);
    }

    public function shortcode_options() {
        if ($_POST) {
            $shortcode = array();
            if (count($_POST['shortcode']) == 1)
                $shortcode = $_POST['shortcode'];
            else {
                foreach ($_POST['shortcode'] as $item) {
                    if (!empty($item)) {
                        $shortcode[] = $item;
                    }
                }
            }
            update_option('qalep_shortcode', $shortcode);
        }
        $shortcodes = $this->get_user_shortcode();
        $this->view('qalep_options',array("shortcodes"=>$shortcodes));
        //ViewLoader::load_view();
    }

    //get user short code
    public function get_user_shortcode() {
        $user_shorcodes = get_option('qalep_shortcode');
        return $user_shorcodes;
    }

}
