(function () {
    'use strict';

    angular.module('users')
            .service('userService', ['$q', '$http', UserService]);

    /**
     * Users DataService
     * Uses embedded, hard-coded data model; acts asynchronously to simulate
     * remote data service call(s).
     *
     * @returns {{loadAll: Function}}
     * @constructor
     */
    
    function UserService($q, $http) {

        this.getData = function () {
            // $http() returns a $promise that we can add handlers with .then()
            return $http({
                method: 'GET',
                url: '/makemenu'
            });
        };
    }

})();
