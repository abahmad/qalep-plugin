<!--<h1><?php echo $title; ?></h1>-->
<body ng-app="myApp" >
    <div ng-controller="NestedListsDemoController" class="nestedDemo qalep-bs">
        <script type="text/ng-template" id="list.html">
            <ul dnd-list="list">
            <li ng-repeat="item in list"
            dnd-draggable="item"
            dnd-effect-allowed="move"
            dnd-moved="list.splice($index, 1)"
            dnd-selected="models.selected = item"
            ng-class="{selected: models.selected === item}"
            ng-include="item.type + '.html'">
            </li>
            </ul>
        </script>

        <script type="text/ng-template" id="container.html" >
            <div ng-class="{'container' : item.properties.fixed == 'true', 'container-fluid' : item.properties.fixed == 'false'}" class="container-element box box-blue" >
            <h3>Container</h3>
            <div class="row" ng-repeat="list in item.columns" ng-include="'list.html'"></div>
            <div class="clearfix"></div>
            </div>
        </script>


        <script type="text/ng-template" id="column.html" >
            <div class="container-element box box-blue col-md-{{item.properties.width}}">
            <h3>Column</h3>
            <div class="qalep-col-inner" ng-repeat="list in item.columns" ng-include="'list.html'">
            <div class="clearfix"></div>
            </div>
            </div>
        </script>

        <!-- Template for a normal list item -->
        <script type="text/ng-template" id="clear.html">
            <div class="item" >
            {{item.label}}
            <div class="item-actions">
            <span class="glyphicon glyphicon-plus" aria-hidden="true" ng-click="list.splice($index, 0, convertItemToObj(item))"></span>
            <span class="glyphicon glyphicon-remove" ng-click="list.splice($index, 1)" aria-hidden="true"></span>
            </div>
            </div>
        </script>

        <script type="text/ng-template" id="title.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="post.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="testimonial.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="divider.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="counting.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="content_box.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="alert.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="button.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="people.html">
            <div class="item" >
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <!--<pre>{{modelAsJson}}</pre>-->                                                                                                          
        <script type="text/ng-template" id="image.html">
            <div class="item" id="{{item.id}}" >
            <img src="{{item.imgSrc}}" class="custom_preview_image" alt="" id="image_img" />
            <input  ng-click="uploadImg($event,$index)" class="custom_upload_image_button button" type="button" value="Choose Image" />
            <br><a href="#"  ng-click="removeImg($event)" class="custom_clear_image_button">Remove Image</a>
            <input name="image" type="hidden" class="custom_upload_image" value="1" id="image_ID" ng-model='item.imgId' />
            </div>
        </script>
        <script type="text/ng-template" id="text.html">
            <div class="item" id="{{item.id}}">
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>
        <script type="text/ng-template" id="url.html">
            <div class="item" id="{{item.id}}">
            {{item.label}}
            <a ng-click='removeElem(item.id)'>x</a>
            </div>
        </script>


        <!-------------------selected item----------------------->
        <div  ng-if="models.selected.properties" class="col-md-12">
            <div ng-if="models.selected" class="box box-grey box-padding">
                <h3>Selected</h3>
                <table>
                    <tr ng-repeat="(key, val) in models.selected.properties">
                        <td> {{key}}</td>
                        <td ng-if="val.choices != undefined && key != 'text'" ng-repeat="(smkey,smval) in val.choices">
                            <span>{{ smval}}</span><input ng-model="models.selected.properties[key].value" type="{{val.input_type}}" value="{{smval}}"/>
                        </td>
                        <td ng-if="val.choices == undefined">
                            <input ng-if="val.input_type == undefined && key != 'text' && key != 'image'" ng-model="models.selected.properties[key]" type="text" value="{{smval}}"/>
                            <div class="item" id="{{item.id}}" ng-if="key == 'image'" >
                                <img src="{{item.imgSrc}}" class="custom_preview_image" alt="" id="image_img" />
                                <input  ng-click="uploadImg($event, $index)" class="custom_upload_image_button button" type="button" value="Choose Image" />
                                <br><a href="#"  ng-click="removeImg($event)" class="custom_clear_image_button">Remove Image</a>
                                <input name="image" type="text" class="custom_upload_image" value="1" id="image_ID" ng-model="models.selected.properties[key]" />
                            </div>
                            <textarea ng-model="models.selected.properties[key]" ng-if="key == 'text'"> {{val}}</textarea>
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

                    <?php
                    //
                   // $user_shortcode = ShortCode::get_user_shortcode();
                    if (!empty($user_shortcode)) {
                        foreach ($user_shortcode as $key => $item) {
                            echo "<script>window.qalep_elements.push({label:'$item',type:'item',value:'$item'});</script>";
                        }
                        ?>
                    </ul>
                    <?php
                }
                //
                if (is_plugin_active('mnbaa_namozagk/mnbaa_namozagk.php')) {
                    // cl
                    if (class_exists('Form')) {
                        $forms = Form::find_all();
                        foreach ($forms as $form) {
                            $val = "[Mnbaa Namozagk Form ID=$form->id]";
                            echo "<script>window.qalep_elements.push({label:'$val',type:'item',value:'$val'});</script>";
                        }
                    }
                }
                // meta slider plugin shortcode
                if (is_plugin_active('ml-slider/ml-slider.php')) {
                    $args = array(
                        'post_type' => 'ml-slider',
                        'post_status' => 'publish',
                        'order' => 'ASC',
                    );
                    $slider_shortcodes = get_posts($args);
                    foreach ($slider_shortcodes as $slider) {
                        $val = "[metaslider id=$slider->ID]";
                        echo "<script>window.qalep_elements.push({label:'$val',type:'item',value:'$val'});</script>";
                    }
                }
                global $post;
                if (isset($post)) {
                    $template_items = (get_post_meta($post->ID, 'template_element', true));
                }
                if (isset($template_items) && !empty($template_items)) {
                    
                    if (json_decode($template_content) == $template_items) {
                        /// echo "yes";
                    } else {
                        echo "not synco";
                    }
                    echo "<script>window.qalep_items=" . $template_items . ";</script>";
                }
                ?>
            </div>
            <div class="qalep-elements">
                <h3 class="title-blocks"><?php echo _e('Drag Element Here', 'qalep'); ?> 
                    <a href="javascript:void(0)" ng-click="models.clear()" class="clear-div"><?php echo _e('Clear Template', 'qalep'); ?> </a>
                </h3>
<!--                <pre>
                    {{modelAsJson}}
                </pre>-->
                <input type="hidden" value="{{modelAsJson}}" name="item"/>
                <div class="row">
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