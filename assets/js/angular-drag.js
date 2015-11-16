
var myApp = angular.module('myApp', ['dndLists', 'ngSanitize']);

window.qalep_elements = [];
window.elements_template = [];


myApp.directive('compilehtml', ["$compile", "$parse", function ($compile, $parse) {
        return {
            restrict: 'A',
            link: function ($scope, element, attr) {
                var parse = $parse(attr.ngBindHtml);
                function value() {
                    return (parse($scope) || '').toString();
                }

                $scope.$watch(value, function () {
                    $compile(element, null, -9999)($scope);
                });
            }
        }
    }]);

//add template for each element 
myApp.run(function ($templateCache) {
    elements = window.elements_template;
    angular.forEach(elements, function (value, key) {
        $templateCache.put(value["key"], value["content"]);
    });
});
//capitalize key for propeties  of element
myApp.filter('capitalize', function () {
    return function (input) {
        return input.replace(/\w\S*/g, function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }
});

myApp.controller("NestedListsDemoController", ['$scope', '$rootScope', '$http', '$sce', '$compile', function ($scope, $rootScope, $http, $sce, $compile) {

        // selected fruits
        $scope.selection = [];

        // toggle selection for a given fruit by name
        $scope.toggleSelection = function toggleSelection(itemName, key) {
             alert(itemName);

            var idx = $scope.selection.indexOf(itemName);

            // is currently selected
            if (idx > -1) {
                $scope.selection.splice(idx, 1);
            }

            // is newly selected
            else {
                $scope.selection.push(itemName);
                $scope.models.selected.properties[key].value = $scope.selection;
            }
        };

        $scope.models = {
            selected: null,
            templates: window.qalep_elements,
            dropzones: {
                "A": (window.qalep_items || [])

            },
            clear: function () {
                window.qalep_items = []
                this.dropzones.A = [];
                $scope.items = {};

            }


        };

        $scope.getInclude = function (_item) {
            return _item.type + '.html';
        }

        $scope.microtime = function (get_as_float) {
            //  discuss at: http://phpjs.org/functions/microtime/
            // original by: Paulo Freitas
            //   example 1: timeStamp = microtime(true);
            //   example 1: timeStamp > 1000000000 && timeStamp < 2000000000
            //   returns 1: true

            var now = new Date()
                    .getTime() / 1000;
            var s = parseInt(now, 10);

            return (get_as_float) ? now : (Math.round((now - s) * 1000) / 1000) + ' ' + s;
        }


        $scope.changeToRandId = function () {
            return $scope.microtime();
        };

        $scope.convertItemToObj = function (_item) {
            return JSON.parse(angular.toJson(_item));
        }
        $scope.draw = function (properties) {
            $scope.items = {};
            if (properties) {
                $http({
                    method: "POST",
                    url: ajaxurl + '?action=get_input',
                    data: {
                        properties: properties
//                        input_type: value.input_type,
//                        choices: value.choices
                    },
                }).success(function (response) {
                    angular.forEach(response, function (value, key) {
                        $scope.items[key] = $sce.trustAsHtml(value);
                    });

                });
            }
        }
        $scope.generate = function (item) {
            $('.post_meta_fileds span').html('');
            $http({
                method: "POST",
                url: ajaxurl + '?action=generate_meta_keys',
                data: {
                    post_type: item
                },
            }).success(function (response) {
                
                $('.post_meta_fileds').html($compile(response)($scope));
                //$compile($('.post_meta_fileds span').content())($scope);


            });
        }

        $scope.load_color = function () {
            var myOptions = {
                // you can declare a default color here,
                // or in the data-default-color attribute on the input
                defaultColor: false,
                // a callback to fire whenever the color changes to a valid color
                change: function (event, ui) {
                    var hexcolor = $(this).wpColorPicker('color');

                    //alert(hexcolor);


                    //  console.log($(".color-field").val());
                    $(".color-field").val(hexcolor).trigger('input');

                },
                // a callback to fire when the input is emptied or an invalid color
                clear: function () {
                },
                // hide the color picker controls on load
                hide: true,
                // show a group of common colors beneath the square
                // or, supply an array of colors to customize further
                palettes: true
            };
            $('.color-field').wpColorPicker(myOptions);

        }

        $scope.uploadImg = function ($event, $index) {
            var image_id;
            formfield = angular.element($event.currentTarget).siblings('.custom_upload_image');
            preview = angular.element($event.currentTarget).siblings('.custom_preview_image');
            tb_show('', 'media-upload.php?type=image&TB_iframe=true');
            window.send_to_editor = function (html) {
                imgurl = jQuery('img', html).attr('src');
                console.log(imgurl);
                classes = jQuery('img', html).attr('class');
                preview.attr('src', imgurl);
                tb_remove();
                $("#image_ID").val(imgurl).trigger('input');
                $scope.$apply();


            };

            return;

        }

        $scope.removeImg = function ($event) {
            var this_btn = angular.element($event.currentTarget);
            // var defaultImage =this_btn.parent().siblings('.custom_default_image').text();
            this_btn.siblings('.custom_upload_image').val('');
            this_btn.siblings('.custom_preview_image').attr('src', '');
            return false;

        }

        $scope.$watch('models.selected', function (model) {
            if (null !== model && model.hasOwnProperty('type') && model.type == 'shortcode' && model.hasOwnProperty('shortcode_base')) {
                var sc_params = '';
                angular.forEach(model.properties, function (v, k) {
                    if (null !== v.value || '' !== v.value) {
                        sc_params += ' ' + k + "='" + v.value + "'";
                    }
                });
                model.value = '[' + model.shortcode_base + ' ' + sc_params + ']';
            }
        }, true);

        $scope.$watch('models.dropzones', function (model) {
            $scope.modelAsJson = angular.toJson(model.A, true);


        }, true);

        $scope.$watch('selection', function (user) {

            $scope.modelAsuser = angular.toJson(user, true);

        }, true);

    }]);