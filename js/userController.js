app.controller('userController', function($scope, users) {

	function getUsers () {
		//call the the service and make ajax call to get all users.
		$scope.users = users.getAllUsers(); 

		//hardcoded scope for testing. 
		// $scope.users = [
		// {
		// 	id: 101,
		// 	first_name: 'greg'
		// }
		// ];
	}
	
	$scope.createUser = function() {
		// insert a new user to the database.
	}

	$scope.updateUser = function(){
		//update user in the database.
		users.updateUser($scope.users);
	}

	$scope.setInactive = function(){
		//sets user as inactive in the db. 
	}

	getUsers();
});