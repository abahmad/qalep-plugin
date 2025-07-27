var $ = jQuery;

//popup window to preview template as it is in front end
jQuery(document).ready(function () {
    //hide result of dropdownlist of post item on init
    
   $(".qalep_tr_post_meta_fileds").css('display','none');
    var dialog = $('#qalep-dialog-view');
    $("#qalep-preview").on('click', function (e) {
        //var items = [];
        $josn_item = $('.qalep-elements').find("input[name='item']");
        e.preventDefault();
        dialog.dialog({
            width: 1000,
            height: 500,
            modal: true,
        });
        $.ajax({
            type: "post",
            url: ajaxurl,
            data: {
                action: "qalep_template_preview",
                items: $josn_item.val()
            },
            success: function (response) {
                $("#qalep-dialog-view").html(response);
            }
        });
    });

    // remove defalut publish metaBox
    var qalep_form = $('input[value="qalep"]').parent();
    qalep_form.find($("#postbox-container-1")).remove();
    qalep_form.find($("#poststuff #post-body.columns-2")).css('marginRight', '0');
    qalep_form.find($("#poststuff #post-body.columns-2")).css('marginLeft', '0');



    //in option page
    $(".add-shortcode").click(function () {
        row = $('#shortcodes').find('tr:first').clone();
        row = row.append('<td ><a href="javascript:void(0)" class="del-row" >X</a></td>');
        row.find('input[type=text]').val('');
        //alert(row);
        $('#shortcodes').append(row);
        row.find('input[type=text]').val();
    });

    // delete item from option qalep page
    $('body').on('click', '.del-row', function () {
        $(this).closest('tr').remove();
    });





});
