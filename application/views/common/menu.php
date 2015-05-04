<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Home Page </title>
        <link href="/public/css/styles.css" type="text/css" rel="stylesheet" />
        <link href="/public/css/bootstrap.css" rel="stylesheet">
        <link href="/public/css/ripples.css" rel="stylesheet">
        <link href="/public/css/material-wfont.css" rel="stylesheet">
        <link href="/public/css/bootstrap.css.map" rel="stylesheet">
        <link href="/public/css/bootstrap-multiselect.css" rel="stylesheet">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,400italic'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-material/0.8.3/angular-material.css"/>
        <link rel="stylesheet" href="/public/css/app.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <!--<body>                         
    <div id="cssmenu" class="bs-component" >
    <div class="navbar navbar-default">
    <div class="container">  
     <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a href="/" style="padding: 0px !important;"><span class="navbar-brand logo"><img src="public/images/logo.png"></span></a>
    <?php
    $stack[100] = array();
    $tos = -1;
    $stack[++$tos] = "0";
    $count = 0;
    ?>
                                    </div>
    
      <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul>
    <?php
    while ($count != count($menuPanelsArray) - 1) {
        $flag = 0;
        for ($i = 0; $i <= count($menuPanelsArray) - 1; $i++) {
            if ($menuPanelsArray[$i]['panel_parent_id'] != $stack[$tos])
                continue;
            else {
                $stack[++$tos] = $menuPanelsArray[$i]['panel_id'];
                $menuPanelsArray[$i]['panel_parent_id'] = -1;
                $flag = 1;
                $count++;
                ?>
                                
                                <li class=''><a class="current" href="<?php echo $menuPanelsArray[$i]['panel_url']; ?>"
                                        title="<?php echo $menuPanelsArray[$i]['panel_name']; ?>"><?php echo $menuPanelsArray[$i]['panel_name']; ?>
                                </a>
                                        <ul>
            <?php
            break;
        }
    }
    if (!$flag) {
        --$tos;
        ?>
                                    </ul>
                            </li>
            <?php
        }
    }
    ?>
                    </ul>
            </ul>
                    <li>
                    <a class="current" href="#"><?php
    if (isset($sessionUserData['user_name'])) {
        echo $sessionUserData['user_name'];
    }
    ?>
    
                                    </a><ul><li style="width: 135px;"><a class="current" href="/logout">Logout</a></li></ul>
                    </li>
                    </div>
    
                    </div>
    </div>
    </div>-->
    <body ng-app="starterApp" layout="column">
        <div ng-controller = "UserController as ul">
            <md-toolbar layout="row">
                <md-button class="menu" hide-gt-sm ng-click="ul.toggleList()" aria-label="Show User List">
                    <md-icon md-svg-icon="menu" ></md-icon>
                </md-button>
                <a class="current" href="#">
                    <img class="logo" src="public/images/logo.png" alt="Happily Unmarried" title="Happily Unmarried" />
                </a>
                <a class="current" href="/logout">
                    <img class="profile_pic" src="public/images/profile_pic.png" title="<?php echo $sessionUserData['user_name']; ?>" />
                </a>
                <a class="arrow_box" style="display: none;" href="#">Logout</a>
            </md-toolbar>

            <div flex layout="row">
                <md-sidenav md-is-locked-open="$mdMedia('gt-sm')" class="md-whiteframe-z2" md-component-id="left" style="height: 100%;background: whitesmoke;">
                    <md-list>
                        <div ng-controller="expandCollapseCtrl" class="expandcollapse-item">
                            <md-item ng-repeat="it in ul.users">

                                <md-button ng-click="ul.selectUser(it); active = !active" ng-class="{'selected' : it === ul.selected }">
                                    <md-icon md-svg-icon="{{it.icon}}" class="avatar"></md-icon>
                                    {{it.menu}}
                                    </md-button>
                                <div class="slideDown" ng-hide="active">
                                    <ul class="expand-collapse-content">
                                        <md-button ng-repeat="subs in it.submenu" ng-href="{{subs.suburl}}" style="display: inline-block;"> 
                                                <li style="color: rgba(0, 0, 0, 0.6) !important;">{{subs.submenu}}</li>
                                            </md-button>
                                    </ul>
                                </div>
                            </md-item></div>
                    </md-list>
                </md-sidenav>
            </div>
        </div>
        <script src="/public/js/angular.js"></script>
        <script src="/public/js/angular-animate.js"></script>
        <script src="/public/js/angular-aria.js"></script>
        <script type="text/javascript" src="/public/js/angular-material.js"></script>

        <script src="/public/template/Users.js"></script>
        <script src="/public/template/UserController.js"></script>
        <script src="/public/template/UserService.js"></script>
        <script src="/public/template/menu.js"></script>


        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/public/js/ripples.js"></script>
        <script type="text/javascript" src="/public/js/material.js"></script>
        <script type="text/javascript" src="/public/js/bootstrap-multiselect.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.4.0/less.js"></script>
        <script type="text/javascript" src = "/public/js/default.js"></script>

        <script>
                                $(document).ready(function() {
                        $.material.init();
                        });        </script>

        <script type="text/javascript">

                    angular
                    .module('starterApp', ['ngMaterial', 'users', 'expandCollapseApp'])
                    .config(function($mdThemingProvider, $mdIconProvider){

                    $mdIconProvider
                            .defaultIconSet("/public/css/svg/avatars.svg", 128)
                            .icon("menu", "/public/css/svg/menu.svg", 24)
                            .icon("share", "/public/css/svg/share.svg", 24)
                            .icon("google_plus", "/public/css/svggoogle_plus.svg", 512)
                            .icon("hangouts", "/public/css/svg/hangouts.svg", 512)
                            .icon("twitter", "/public/css/svg/twitter.svg", 512)
                            .icon("phone", "/public/css/svg/phone.svg", 512);
                            $mdThemingProvider.theme('default')
                            .primaryPalette('blue')
                            .accentPalette('red');
                    });

        </script>

    </body>
</html>