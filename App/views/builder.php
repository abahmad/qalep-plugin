<body ng-app="myApp" >
    <div ng-controller="NestedListsDemoController" class="nestedDemo qalep-bs">
        <script type="text/ng-template" id="list.html">
            <ul dnd-list="list">
            <li ng-repeat="item in list"
            dnd-draggable="item"
            dnd-effect-allowed="move"
            dnd-moved="list.splice($index, 1)"
            dnd-selected="models.selected = item;"
            ng-class="{selected: models.selected === item}"
            ng-click="draw(item.properties)"
            ng-include="item.type + '.html'">
            </li>
            </ul>
        </script>


        <!-- Template for a shortcode item -->
        <script type="text/ng-template" id="shortcode.html">
            <div class="item" id="{{item.id}}">
            {{item.label}}
           <div class="item-actions"><span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span></div>
            </div>
        </script>


        <!-------------------selected item----------------------->
        <div  ng-if="models.selected.properties" >
            <div ng-if="models.selected" class="box box-grey box-padding">
                <h3><?php echo _e('Selected', "qlp"); ?></h3>
                <!--ng-init="draw(models.selected.properties)"-->
                <table class="table table-bordered" >

                    <tr ng-repeat="(key, val) in items">
                        <td>{{key|capitalize}}</td>
                        <td> <span ng-bind-html="val" compilehtml></span></td>
                    </tr>
<!--                    <tr ng-repeat="(key, val) in items">
                        <td> {{key}}</td>
                        <td ng-if="val.input_type">
                           <span ng-bind-html="items"></span>
                        </td>
                        <td ng-if="val.input_type == undefined">
                            <input ng-if ="key != 'text' && key != 'image'" ng-model="models.selected.properties[key]" type="text" value="{{models.selected.properties[key]}}"/>
                            <div class="item" id="{{item.id}}" ng-if="key == 'image'" >
                                <img src="{{models.selected.properties[key]}}" class="custom_preview_image" alt="" id="image_img" />
                                <input  ng-click="uploadImg($event, $index)" class="custom_upload_image_button button" type="button" value="Choose Image" />
                                <br><a href="#"  ng-click="removeImg($event)" class="custom_clear_image_button">Remove Image</a>
                                <input name="image" type="hidden" class="custom_upload_image" value="1" id="image_ID" ng-model="models.selected.properties[key]" />
                            </div>
                            <textarea ng-model="models.selected.properties[key]" ng-if="key == 'text'"> {{val}}</textarea>
                        </td>
                    </tr>-->
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
                <h3 class="title-blocks"><?php echo _e('Drag Element Here', 'qalep'); ?> 
                    <a href="javascript:void(0)" ng-click="models.clear()" class="clear-div"><?php echo _e('Clear Template', 'qalep'); ?> </a>
                </h3>
<!--                <pre>
                    {{modelAsJson}}
                </pre>-->
                <input type="hidden" value="{{modelAsJson}}" name="item"/>
                <div ng-repeat="(zone, list) in models.dropzones" >
                    <div class="dropzone box box-yellow">
                        <!-- The dropzone also uses the list template -->
                        <div ng-include="'list.html'">
                            {{ models.dropzones.A}}
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <div class="qalep-btns">
            <?php
            // submit_button();

            submit_button($text = __('Save', 'qalep'), $type = 'primary', $name = 'publish', $wrap = true, $other_attributes = NULL);
            if (isset($_GET['post']))
                submit_button($text = "Preview", $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = array('id' => 'qalep-preview'));
            ?>
        </div>
    </div>
    <div id="qalep-dialog-view"></div>
</body>