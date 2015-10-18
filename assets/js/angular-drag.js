
var myApp = angular.module('myApp', ['dndLists', 'ngSanitize']);
/*
 * The controller doesn't do much more than setting the initial data model
 * 
 */
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

myApp.controller("NestedListsDemoController", ['$scope', '$rootScope', '$http', '$sce', function ($scope, $rootScope, $http, $sce) {

        $scope.models = {
            selected: null,
            templates: window.qalep_elements,
            dropzones: {
                "A": (window.qalep_items || [])

            },
            clear: function () {
                window.qalep_items = []
                this.dropzones.A = [];

            }


        };

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
        $scope.draw = function (val) {
            $scope.items = {};
            angular.forEach(val, function (value, key) {
//                if (value.input_type) {
                $http({
                    method: "POST",
                    url: ajaxurl + '?action=get_input',
                    data: {
                        input_type: value.input_type,
                        input_values: value.value
                    },
                }).success(function (response) {
                    htmlResponse = $sce.trustAsHtml(response);
                    $scope.items[key] = htmlResponse;
                });
//                }
            });



        }
        $scope.$watch('data', function (data) {
            $scope.newdata = data;
        }, true);

        $scope.uploadImg = function ($event, $index) {
            var image_id;
            formfield = angular.element($event.currentTarget).siblings('.custom_upload_image');
            preview = angular.element($event.currentTarget).siblings('.custom_preview_image');
            tb_show('', 'media-upload.php?type=image&TB_iframe=true');
            window.send_to_editor = function (html) {
                imgurl = jQuery('img', html).attr('src');
                classes = jQuery('img', html).attr('class');
                image_id = classes.replace(/(.*?)wp-image-/, '');
                formfield.val(image_id);
                //alert(formfield.val(image_id));
                preview.attr('src', imgurl);
                tb_remove();
                if ($scope.models.dropzones.A[$index] === undefined) {
                    alert("people");
                    $scope.models.dropzones.A[0].properties.image = imgurl;
                } else {
                    $scope.models.dropzones.A[0].imgSrc = imgurl;
                }

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

        $scope.$watch('models.dropzones', function (model) {
            $scope.modelAsJson = angular.toJson(model.A, true);
        }, true);




    }]);