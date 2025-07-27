
<body ng-app="myApp" >
    <div ng-controller="NestedListsDemoController" class="nestedDemo qalep-bs">
        <script type="text/ng-template" id="list.html">
            <ul dnd-list="list" class="clearfix">
            <li ng-repeat="item in list"
            dnd-draggable="item"
            dnd-effect-allowed="move"
            dnd-moved="list.splice($index, 1)"
            dnd-selected="models.selected = item;"
            ng-class="{'selected': models.selected === item, 'list-container': item.type == 'container', 'list-column': item.type == 'column'}"
            ng-click="draw(item.properties)"
            ng-include="getInclude(item)">
            </li>
            </ul>
        </script>


        <!-- Template for a shortcode item -->
        <script type="text/ng-template" id="shortcode.html">
            <div class="item" id="{{item.id}}" ng-init="item.value = item.value == undefined ? '[' + item.shortcode_base + ']' : item.value">
            {{item.label}}
            <div class="item-actions"><span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span></div>
            </div>
        </script>
        <script type="text/ng-template" id="shortcode_container.html">
            <div class="container-fluid">
            <div class="container-element box box-blue">     
            <h3>{{item.label}}</h3>
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            <div class="clearfix"></div>
            </div></h3>
            <div class="row" ng-repeat="list in item.columns" ng-include="'list.html'"></div>
            <div class="clearfix"></div>
            </div>
            </div>
        </script>


        <!-------------------selected item----------------------->
        <div  ng-if="models.selected.properties" >
            <div ng-if="models.selected" class="box box-grey box-padding">
                <h3>{{models.selected.label}}</h3>
                <!--ng-init="draw(models.selected.properties)"-->

                <table class="table table-bordered" >
                    <!--<tr class=><td span ="hd"></td></tr>-->
<!--                    <tr  class ="hd"ng-repeat="(key, val) in res">
                        <td>{{key|capitalize}}</td>

                        <td class="{{key}}"> <span ng-bind-html="val" compilehtml>{{val}}</span>
                        </td>
                    </tr>-->
                    <tr ng-repeat="(key, val) in items" class="qalep_tr_{{key}}"  >

                        <td>{{key|capitalize}}</td>

                        <td  class="{{key}}" ng-init="current_key = key"> <span ng-bind-html="val" compilehtml></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


        <div id="creator" >
            <div id="qalep-draggable">
                <h3 class="title-blocks"><?php echo _e('Avaliable Elemnets', 'qalep'); ?> </h3>
                <ul>
                    <!-- The toolbox only allows to copy objects, not move it. After a new
                         element was created, dnd-copied is invoked and we generate the next id -->
                    <li ng-repeat="item in models.templates"
                        dnd-draggable="item"
                        dnd-effect-allowed="copy">
                        <!--dnd-copied="item.id = item.id + 1"-->
                        <button type="button" class="draggable-item" >{{item.label}}</button>
                    </li>
                </ul>
                <?php echo isset($template_items) ? "<script>window.qalep_items=" . $template_items . ";</script>" : '' ?>

            </div>
            <div class="qalep-elements">
                <h3 class="title-blocks"><?php echo __('Drag Element Here', 'qalep'); ?> 
                    <a href="javascript:void(0)" ng-click="models.clear()" class="clear-div"><?php echo _e('Clear Template', 'qalep'); ?> </a>
                </h3>
<!--                <pre>{{modelAsuser}}</pre>-->
<!--                <pre>
                    {{modelAsJson}}
                </pre>-->
                <input type="hidden" value="{{modelAsJson}}" name="item"/>
                <div ng-repeat="(zone, list) in models.dropzones" >
                    <div class="dropzone builder-container">
                        <!-- The dropzone also uses the list template -->
                        <div ng-include="'list.html'">
                            {{ models.dropzones.A}}
                        </div>
                    </div>
                </div>
            </div>




        </div>

        <div class="set-template-for">
            <div class="form-group">
                <select name="assign-template-to" class="form-control">
                    <label>Assign template to</label>
                    <optgroup label="Default Templates">
                        <option value="" selected="selected" >Page Template</option>
                        <option value="qalep-front-page">Front Page Template</option>
                        <option value="qalep-index">Blog Index Template</option>
                        <option value="qalep-category">Blog Category Template</option>
                        <option value="qalep-archive">Blog Archive Template</option>
                        <option value="qalep-search">Blog Search page Template</option>
                    </optgroup>
                    <optgroup label="Post / Custom post types">
                        <?php
                        $types = get_post_types(array('public' => true));

                        foreach ($types as $type) {
                            if (!empty($type)) {
                                ?>
                                <option value="qalep-single-<?php echo $type; ?>"><?php echo ucfirst($type) ?> Single Template</option>
                                <option value="qalep-archive-<?php echo $type; ?>"><?php echo ucfirst($type); ?> Archive Template</option>
                                <?php
                            }
                        }
                        ?>
                    </optgroup>

                    <optgroup label="Taxonamies">
                        <?php
                        $taxonomies = get_taxonomies(array(
                            'public' => true
                        ));
                        foreach ($taxonomies as $taxonomy) {
                            // need the actual slug?  this will do it...
                            if (!empty($taxonomy)) {
                                // you'll probably want to do something else.
                                $value = "taxonamy-" . $taxonomy;
                                ?>
                                <option value="taxonamy-<?php echo $taxonomy; ?>"><?php echo ucfirst($taxonomy) ?> Template</option>
                                <?php
                            }
                        }
                        ?>
                    </optgroup>

                    <optgroup label="Categories / Hierarchical Taxonamy Terms">

                        <?php
                        foreach ($taxonomies as $taxonomy) {
                            if (!empty($taxonomy)) {

                                echo '<optgroup label="&nbsp;&nbsp;&nbsp;' . ucfirst($taxonomy) . '">';
                                $s1 = preg_replace('/<select(.+)>/i', '', wp_dropdown_categories('taxonomy=' . $taxonomy . '&hide_empty=0&hierarchical=1&value_field=slug&selected=0&echo=0'));
                                $s2 = preg_replace('/value="([^\"]+)"/i', 'value="qalep-taxonamy-' . $taxonomy . '-$1"', $s1);
                                $s3 = str_replace('</select>', '', $s2);
                                echo $s3;
                                echo '</optgroup>';
                            }
                        }
                        ?>
                    </optgroup>

                </select>
            </div>
        </div>
        <script>
                    $(".form-control option").each(function ()
                    {
                        var option = ($(this).val())
                        var template = "<?php echo $template_name; ?>";
                        if (option == template) {
                            $(this).attr('selected', 'selected');
                        }
                    });
        </script>
        <div class="qalep-btns">
            <?php
            submit_button($text = __('Save', 'qalep'), $type = 'primary', $name = 'publish', $wrap = true, $other_attributes = NULL);
            if (isset($_GET['post']))
                submit_button($text = __('Preview', 'qalep'), $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = array('id' => 'qalep-preview'));
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="qalep-dialog-view"></div>
</body>