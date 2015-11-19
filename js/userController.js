app.controller('userController', function($scope, users, $timeout) {

    //Sorting
    // set the default sort field
    $scope.sortType     = 'id'; 
    $scope.sortReverse  = false;
    $scope.showSuccess  = false;
    $scope.ShowFailure  = false; 
    
    function getUsers() {
        //call the the service and make http request to get all users.
        users.getAllUsers().then(function(data){
            displayAlert(data);
            //if the msg property is not defined then we know the request successfully returned users.
            if (typeof data.msg === "undefined") {
                $scope.users = data;
            } 
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
        }, 500);
    }

    function displayAlert(data){
    //Displays the Message box in the view with the message, and will clear it after 3 seconds. 
        if (data.Success === true) {
            $scope.showSuccess = true;
        } else if (data.Success === false) {
            $scope.ShowFailure = true;
        }
        //Calling getUsers will overwrite the .msg property and set to undefined on success. To avoid that: 
        if (typeof data.msg != "undefined") {
            $scope.msg = data.msg;
        }
        //Clear the msg box after 4 seconds. Using angular's $timeout instead of SetTimeout() . 
        //$timeout Needed to be injected into controller.

        $timeout(function(){
            $scope.showSuccess  = false;
            $scope.ShowFailure  = false;
        }, 4000);
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
            scroll();
            $timeout(function(){
                displayAlert(data);
            },  1000);
            getUsers();
        });
    }
    getUsers();
});