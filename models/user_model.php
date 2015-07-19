<?php 

class User{

	protected $user_id;
	protected $first_name;
	protected $last_name;
	protected $password;
	protected $dbc;

	public function __construct($dbc)
	{
		$this->dbc = $dbc;
	}

	/**
	 * [getUsers() description - returns all or  specified user from the database.] 
	 * @param  int $user_id - if null then will get all users. 
	 */

	function getUsers($user_id = "")
	{

		$sql = "SELECT * FROM users";
		if ($user_id != "") {
			$sql .= " WHERE id = '" . $user_id . "'";
			
		}

	}

	/**
	 * [addUser() description - adds a new user to the database.]
	 */
	function addUser()
	{
		$sql = "INSERT INTO users
		(first_name, last_name, email_address, password)
		VALUES()";

	}

	function updateUser()
	{

		$sql = "UPDATE users SET";

	}

	function setInactive()
	{
		$sql = "UPDATE users 
		SET is_active = 'N' 
		WHERE id = '" . $user_id . "'";

	}	
}

?>