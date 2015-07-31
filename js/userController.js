app.controller('userController', function($scope, users) {

	function getUsers () {
		//call the the service and make ajax call to get all users.
		users.getAllUsers().then(function(data){
			$scope.users = data;
		}); 
		// console.log($scope.users);

		//hardcoded scope for testing. 
		// $scope.users = [
		// {
		// 	id: 101,
		// 	first_name: 'greg'
		// }
		// ];
	}
	
	$scope.createUser = function(user) {
		// insert a new user to the database.
		users.addUser(user).then(function(data){
			getUsers();
		});
	}

	$scope.updateUser = function(){
		//update user in the database.
		users.updateUser(user).then(function(data){
			getUsers();
		})
	}

	$scope.setInactive = function(){
		//sets user as inactive in the db. 
	}

	getUsers();
});