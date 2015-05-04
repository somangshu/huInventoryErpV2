(function(){

  angular
       .module('users')
       .controller('UserController', [
          'userService', '$mdSidenav', '$mdBottomSheet', '$log', '$q','$location',
          UserController
       ]);

  /**
   * Main Controller for the Angular Material Starter App
   * @param $scope
   * @param $mdSidenav
   * @param avatarsService
   * @constructor
   */
  
  function UserController( userService, $mdSidenav, $mdBottomSheet, $log, $q, $location) {
    var self = this;
    
    self.selected     = null;
    self.users        = [ ];
    self.location1 = null;
    self.selectUser   = selectUser;
    self.toggleList   = toggleUsersList;
    self.share        = share;
    self.goTo   = goTo;
    // Load all registered users
    userService.getData().then(function(dataResponse) {
        
        self.users    = [].concat(dataResponse.data);
        console.log(self.users)
        self.selected = dataResponse.data[0].submenu[0];
        console.log(self.selected)
        
    });

    // *********************************
    // Internal methods
    // *********************************

    /**
     * First hide the bottomsheet IF visible, then
     * hide or Show the 'left' sideNav area
     */
    function toggleUsersList() {
      var pending = $mdBottomSheet.hide() || $q.when(true);

      pending.then(function(){
        $mdSidenav('left').toggle();
      });
    }

    /**
     * Select the current avatars
     * @param menuId
     */
    function selectUser ( user ) {
      self.selected = angular.isNumber(user) ? $scope.users[user] : user;
//      console.log(self.selected);
      self.toggleList();
    }

    function goTo ( url ) {
        console.log($location.path(url))
      $location.path(url);
      
    }
    
    
    /**
     * Show the bottom sheet
     */
    function share($event) {
        var user = self.selected;

        $mdBottomSheet.show({
          parent: angular.element(document.getElementById('content')),
          templateUrl: '/application/views/contactSheet.html',
          controller: [ '$mdBottomSheet', UserSheetController],
          controllerAs: "vm",
          bindToController : true,
          targetEvent: $event
        }).then(function(clickedItem) {
          clickedItem && $log.debug( clickedItem.name + ' clicked!');
        });

        /**
         * Bottom Sheet controller for the Avatar Actions
         */
        function UserSheetController( $mdBottomSheet ) {
          this.user = user;
          this.items = [
            { name: 'Phone'       , icon: 'phone'       , icon_url: '/public/css/svg/phone.svg'},
            { name: 'Twitter'     , icon: 'twitter'     , icon_url: '/public/css/svg/twitter.svg'},
            { name: 'Google+'     , icon: 'google_plus' , icon_url: '/public/css/svg/google_plus.svg'},
            { name: 'Hangout'     , icon: 'hangouts'    , icon_url: '/public/css/svg/hangouts.svg'}
          ];
          this.performAction = function(action) {
            $mdBottomSheet.hide(action);
          };
        }
    }

  }

})();
