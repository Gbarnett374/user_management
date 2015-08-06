app.controller('userController', function($scope, users) {

	//Sorting
	// set the default sort field
	$scope.sortType     = 'id'; 
  	$scope.sortReverse  = false; 
  	
	function getUsers () {
		//call the the service and make ajax call to get all users.
		users.getAllUsers().then(function(data){
			$scope.users = data;
		}); 
	}

	function clearForm(){
		$scope.user = {};
		$scope.userForm.$setPristine()
		// $scope.userform.$setValidity();
		$scope.visible = false;
	}

	function scroll(){
	    $('html, body').animate({
	        scrollTop: $('body').offset().top
	    }, 1000);
	}

	$scope.clearForm = function(){
		clearForm();
	}

	$scope.createUser = function(user){
		// insert a new user to the database.
		users.addUser(user).then(function(data){
			//clear scope.
			clearForm();
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
		//scope visible is used to toggle add or edit button on form. 
		$scope.visible = true;
		scroll();
	}

	$scope.updateUser = function(user){
		//update user in the database.
		users.updateUser(user).then(function(data){
			//clear scope & set visible to false for edit button.
			clearForm();
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