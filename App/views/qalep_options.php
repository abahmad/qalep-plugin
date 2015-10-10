<form action="" method="post">

    <br>
    <a href="javascript:void(0)" class="add-shortcode"> add more one</a>
    <table id="shortcodes">
        <?php
        if ($shortcodes) {
            foreach ($shortcodes as $key => $item) {
                ?>
                <tr>
                    <td><label><?php _e('Shortcode', 'qalep'); ?></label></td>
                    <td><input type="text" name="shortcode[]" value="<?php echo $item; ?>"></td>
                    <?php if ($key != 0) { ?><td ><a href="javascript:void(0)" class="del-row" >X</a></td><?php } ?>

                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td><label><?php _e('Shortcode', 'qalep'); ?></label></td>
                <td><input type="text" name="shortcode[]"></td>


            </tr>
        <?php } ?>
    </table>
    <input type="submit" value="submit" class="button" />

</form>
