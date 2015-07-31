<?php 

class User
{

	protected $user_id;
	protected $first_name;
	protected $last_name;
	protected $password;
	protected $dbc;

	public function __construct($dbc, $user_id = "")
	{
		$this->dbc = $dbc;
		$this->user_id = $user_id;
	}

	/**
	 * [getUsers() description - returns all or  specified user from the database.] 
	 * @param  int $user_id - if null then will get all users. 
	 */

	function getUsers($user_id = "")
	{
		$return_array = array();
		$sql = "SELECT * FROM users.users";
		if ($user_id != "") {
			$sql .= " WHERE id = '" . $user_id . "'";
			
		}

		$query = $this->dbc->query($sql);
		while ($results = $query->fetch_assoc()) {
			array_push($return_array, $results);
		} 

		return $return_array;

	
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