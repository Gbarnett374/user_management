app.controller('userController', function($scope, users, $timeout) {

	//Sorting
	// set the default sort field
	$scope.sortType     = 'id'; 
  	$scope.sortReverse  = false;
  	$scope.showSuccess  = false;
  	$scope.ShowError	= false; 
  	
	function getUsers () {
		//call the the service and make http request to get all users.
		users.getAllUsers().then(function(data){
			$scope.users = data;
		}); 
	}

	function clearForm(){
		$scope.user = {};
		$scope.userForm.$setPristine()
		$scope.visible = false;
	}

	function scroll(){
	    $('html, body').animate({
	        scrollTop: $('body').offset().top
	    }, 1000);
	}

	function displayAlert(data){
	//Displays the Message box in the view with the message, and will clear it after 3 seconds. 
		if (data.Success === true) {
			$scope.showSuccess = true;
		} else if (data.Success === false) {
			$scope.ShowError = true;
		}

		$scope.msg = data.msg;
		//Clear the msg box after 3 seconds. Using angular's $timeout instead of SetTimeout() . 
		//$timeout Needed to be injected into controller.

		$timeout(function(){
			$scope.showSuccess  = false;
  			$scope.ShowError	= false;
		}, 3000);
	}

	$scope.clearForm = function(){
		clearForm();
	}

	$scope.createUser = function(user){
		// insert a new user to the database.
		users.addUser(user).then(function(data){
			//clear scope.
			clearForm();
			//Display a div notifiying the user if action was successful or not.
			displayAlert(data);
			//Grab all the users. 
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
			displayAlert(data);
			getUsers();
		});
	}

	$scope.setInactive = function(user_id){
		//sets user as inactive in the db. 
		users.setInactive(user_id).then(function(data){
			displayAlert(data);
			getUsers();
		});
	}
	getUsers();
});