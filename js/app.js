var app = angular.module('userManagement', [] );

app.service('users', ['$http', function ($http) {

    // var base_url = '/controllers/user_controller.php';
    var base_url = '/user_management/controllers/user_controller.php';
    this.getAllUsers = function() {
        return $http.get(base_url).then(function success(res) {
            return res.data;
        }, 
        function error(res) {
            return returnError();
        });
    }

    this.getUser = function(user_id) {
        return $http.get(base_url + '?id=' + user_id).then(function success(res) {
            return res.data;
        },
        function error(res) {
            return returnError();
        });
    }

    this.addUser = function(user) {
        return $http.post(base_url + '?add=y', user).then(function success(res) {
            return res.data 
        },
        function error(res) {
            return returnError();
        });
    }

    this.updateUser = function(user) {
        return $http.put(base_url + '?update=y', user).then(function success(res){
            return res.data;
        },
        function error(res) {
            return returnError();
        });
    }

    this.setInactive = function(user_id) {
        return $http.put(base_url + '?setInactive=y', user_id ).then(function success(res){
            return res.data;
        },
        function error(res) {
            return returnError();
        });
    }

    function returnError() {
        return {
            Success: false,
            msg: "Something went wrong. We are sorry for the inconvenience."
        };
    }
}]);