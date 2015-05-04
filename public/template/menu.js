var expandCollapseApp = angular.module('expandCollapseApp', ['ngAnimate']);

expandCollapseApp.controller('expandCollapseCtrl', function ($scope, $location) {
    $scope.active = true;
    $scope.active1 = true;
    $scope.moduleIco =
            {
                "ModuleIco": [
                    "public/images/svg/design/ic_timer_auto_48px.svg",
                    "public/images/svg/design/ic_settings_ethernet_48px.svg",
                    "public/images/svg/design/instagram19.svg",
                    "edituser"
                ]
            };

    $scope.goTo = function (url) {
//                
        $location.path(url);
//        console.log($location.path(url))
        
    }


//        console.log($scope.moduleIco.ModuleIco[0])

});