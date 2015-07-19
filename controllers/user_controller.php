<?php

if (isset($_REQUEST['add'])) {

	$user = NEW user($dbc, $first_name, $last_name, $email_address, $password);
	
}
else if (isset($_REQUEST['update'])) {
	$user = NEW user($dbc);
	
}
else if(isset($_REQUEST['setInactive'])) {
	$user = NEW user($dbc, $user_id);
	
}
else if(isset($_REQUEST['getUser'])) {
	$user = NEW user($dbc, $user_id );
	
}
else{
	$user = NEW user($dbc);
	include('index.php');
}






?>