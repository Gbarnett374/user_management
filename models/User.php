<?php 

namespace Models;

class User
{
    protected $user_id;
    protected $first_name;
    protected $last_name;
    protected $password;
    protected $email_address;
    protected $dbc;

    public function __construct($dbc, $user_id = "")
    {
        //Set the database connection then set and escape the user id. 
        $this->dbc = $dbc;
        $this->user_id = $this->dbc->real_escape_string($user_id);
    }
/**
 * [setProperties - Sets the properties of the object and escapes the inputs.]
 * @param [array] $user_data [an array of the user inputs]
 */
    function setProperties($user_data)
    {
        //Set properties and escape inputs. 
        foreach($user_data as $k => $v) {
            if (!empty($v) && $v != '') {
                if ($k == 'id') {
                    $this->user_id = $this->dbc->real_escape_string($v);
                } else {                    
                    $this->$k = $this->dbc->real_escape_string($v);
                }   
            } else {
                throw new Exception("One of the properties does not have a value");
            }
        }
    }

    /**
     * [getUsers() description - returns all or specified user from the database. if null then will get all users. ] 
     * @return array $return_array - An array containg a specific user or all the active users in the table. 
     */

    function getUsers()
    {
        $return_array = array();
        $sql = "SELECT * FROM users 
        WHERE is_active = 'Y'";
        if ($this->user_id != "") {
            $sql .= " AND id = '{$this->user_id}'";   
        }

        if (!$query = $this->dbc->query($sql)) {
            throw new Exception("Error! Cannot get User's");
        }
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
        VALUES(
            '{$this->first_name}',
            '{$this->last_name}', 
            '{$this->email_address}', 
            '{$this->password}'
            )";

        if (!$query = $this->dbc->query($sql)) {
            throw new Exception("Error! Cannot add new user");
        }
    }
/**
 * updateUser() updates a user in the database.
 */
    function updateUser()
    {
        $sql = "UPDATE users SET 
        first_name    = '{$this->first_name}',
        last_name     = '{$this->last_name}',
        email_address = '{$this->email_address}',
        password      = '{$this->password}'
        WHERE id      = '{$this->user_id}'";

        if (!$query = $this->dbc->query($sql)) {
            throw new Exception("Error! Cannot update user" . $this->dbc->error);
        }
    }
/**
 * setInactive() sets a user in the database to in active. 
 */
    function setInactive()
    {
        $sql = "UPDATE users 
        SET is_active = 'N' 
        WHERE id = '{$this->user_id}'";

        if (!$query = $this->dbc->query($sql)) {
            throw new Exception("Error deactivating user!");
        }
    }   
}