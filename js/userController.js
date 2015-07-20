app.controller('userController', function($scope, users) {

	function getUsers () {
		//call the the service and make ajax call to get all users.
		$scope.users = users.getAllUsers(); 
	}
	
	$scope.createUser = function() {
		// insert a new user to the database.
	}

	$scope.updateUser = function(){
		//update user in the database.
	}

	$scope.setInactive = function(){
		//sets user as inactive in the db. 
	}

	getUsers();
});