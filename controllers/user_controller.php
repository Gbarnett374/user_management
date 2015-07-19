<?php
require "../.db.php";
require "../models/user_model.php";

/**
 * This controller will be hit via AJAX and return jSON to the view. 
 */

if (isset($_REQUEST['add'])) {
	try {
		$user = NEW user($dbc, $first_name, $last_name, $email_address, $password);	
		$user->addUser();
		
	}
	catch (Exception $e) {
		//return error msg to view. 
	}
}
else if (isset($_REQUEST['update'])) {
	try {
		$user = NEW user($dbc);	
		$user->updateUser();

	}
	catch (Exception $e) {
		
	}
}
else if (isset($_REQUEST['setInactive'])) {
	
	try { 
		$user = NEW user($dbc, $user_id);
	}
	catch (Exception $e) {

	}
}
else if (isset($_REQUEST['getUser'])) {
	try { 
		$user = NEW user($dbc, $user_id );	
	}
	catch (Exception $e) {

	}	
}
else {
	try{
		$user = NEW user($dbc);
	}
	catch (Exception $e) {

	}
}

?>