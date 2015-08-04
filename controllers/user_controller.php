<?php
require "../include/db.php";
require "../models/user_model.php";
/**
 * This controller will be hit via AJAX and return jSON to the view. 
 *Note when using post/put we need to grab the input stream & assign to a variable. 
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
		$putdata = file_get_contents("php://input");
        $data = json_decode($putdata, true);
		$user = NEW user($dbc);
		$user->setProperties($data);
		$user->updateUser();
		return json_encode($data);

	}
	catch (Exception $e) {
		echo $e->getMessage();
	}
}
else if (isset($_REQUEST['setInactive'])) {
	
	try { 
		$putdata = file_get_contents("php://input");
        $data = json_decode($putdata, true);
        $user_id = $data;
		$user = NEW user($dbc, $user_id);
		$user->setInactive();
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