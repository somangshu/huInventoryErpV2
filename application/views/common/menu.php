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
                <h1 style="text-align: left;">Happily Unmarried</h1>
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
                                    <md-icon ng-model="moduleIco.ModuleIco" md-svg-icon="{{moduleIco.ModuleIco[1]}}" class="avatar"></md-icon>
<!--                                    <material-icon icon = "public/images/svg/design/ic_timer_auto_48px.svg"> </material-icon> -->
                                    
                                    {{it.menu}}
                                    </md-button>
                                <div class="slideDown" ng-hide="active">
                                    <ul class="expand-collapse-content">
                                            <md-button ng-repeat="subs in it.submenu" ng-class="{'selected' : it === ul.selected }"> 
                                                <li style="color: rgba(0, 0, 0, 0.6) !important;">{{subs}}</li>
                                            </md-button>
                                    </ul>
                                </div>
                            </md-item></div>
                    </md-list>
                </md-sidenav>

                <!--    accordian example    <div ng-controller="expandCollapseCtrl" class="expandcollapse-item">
                        <div ng-click="active = !active" ng-class="{'expandcollapse-heading-collapsed': active, 'expandcollapse-heading-expanded': !active}">
                          <p>Item 1</p></p>
                        </div>
                
                        <div class="slideDown" ng-hide="active">
                          <div class="expand-collapse-content">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                            on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                            raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>-->
<!--                <md-content flex id="content">
                    <md-icon md-svg-icon="{{ul.selected.menu}}" class="avatar"></md-icon>
                    <h2>{{ul.selected.submenu}}</h2>
                    <p>{{ul.selected.content}}</p>

                    <md-button class="share" md-no-ink ng-click="ul.share($event)" aria-label="Share">
                        <md-icon md-svg-icon="share"></md-icon>
                    </md-button>
                </md-content> -->

            </div>
        </div>
        <script src="/public/js/angular.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular-animate.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular-aria.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-material/0.8.3/angular-material.js"></script>

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
                            .primaryPalette('green')
                            .accentPalette('red');
                    });

        </script>

    </body>
</html>