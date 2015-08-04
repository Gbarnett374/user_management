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
	
	$scope.createUser = function(user){
		// insert a new user to the database.
		users.addUser(user).then(function(data){
			//clear scope.
			$scope.user = {};
			getUsers();
		});
	}

	$scope.editUser = function(user){
		$scope.user = {
			id: user.id,
			first_name: user.first_name,
			last_name: user.last_name,
			email_address: user.email_address,
			password: user.password,
			password2: user.password
		};
		$scope.visible = true;
	}

	$scope.updateUser = function(user){
		//update user in the database.
		users.updateUser(user).then(function(data){
			//clear scope & set visible to false for edit button.
			$scope.user = {};
			$scope.visible = false;
			getUsers();
		});
	}

	$scope.setInactive = function(user_id){
		//sets user as inactive in the db. 
		users.setInactive(user_id).then(function(data){
			getUsers();
		});
	}

	getUsers();
});