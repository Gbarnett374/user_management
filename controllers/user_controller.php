<?php
require "../include/db.php";
require "../models/user_model.php";
/**
 * This controller will be hit via AJAX and return jSON to the view. 
 */

if (isset($_REQUEST['add'])) {
	try {
		$postdata = file_get_contents("php://input");
        $data = json_decode($postdata, true);
		$user = NEW user($dbc);	
		$user->setProperties($data);
		$user->addUser();

		return json_encode($data);
		
	}
	catch (Exception $e) {
		//return error msg to view. 
	}
}
else if (isset($_REQUEST['update'])) {
	try {
		$user = NEW user($dbc);
		$postdata = file_get_contents("php://input");
        $data = json_decode($postdata, true);	
		$user->updateUser();
		return json_encode($data);

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
		echo json_encode($user->getUsers());

	}
	catch (Exception $e) {

	}
}

?>