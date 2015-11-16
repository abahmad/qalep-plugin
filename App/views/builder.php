
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

                    <tr ng-repeat="(key, val) in items">
                        <td>{{key|capitalize}}</td>
                        <td class="{{key}}"> <span ng-bind-html="val" compilehtml></span></td>
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
                <pre>{{modelAsuser}}</pre>
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