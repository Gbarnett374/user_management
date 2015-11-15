<?php
require "../include/db.php";
require "../models/user_model.php";
/**
 * This controller will be hit via HTTP requests and return jSON to the view. 
 *Note when using post/put we need to grab the input stream & assign to a variable. 
 */

if (isset($_REQUEST['add'])) {
    
    try {
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata, true);
        $user = new user($dbc); 
        $user->setProperties($data);
        $user->addUser();

        $return_data = array('Success' => true,
            'msg' => "Successfully added new user!");
        echo json_encode($return_data); 

    } catch (Exception $e) {
        //return error msg to view. 
        $return_data = array('Success' => false,
            'msg' => "An error occured unable to add new user!");
        echo json_encode($return_data);     
    }

} else if (isset($_REQUEST['update'])) {
    
    try {
        $putdata = file_get_contents("php://input");
        $data = json_decode($putdata, true);
        $user = new user($dbc);
        $user->setProperties($data);
        $user->updateUser();

        $return_data = array('Success' => true,
            'msg' => "Successfully updated user!");
        echo json_encode($return_data);

    } catch (Exception $e) {
        $return_data = array('Success' => false,
            'msg' => "An error occured unable to update user!");
        echo json_encode($return_data);
    }

} else if (isset($_REQUEST['setInactive'])) {
    
    try { 
        $putdata = file_get_contents("php://input");
        $data = json_decode($putdata, true);
        $user_id = $data;
        $user = new user($dbc, $user_id);
        $user->setInactive();

        $return_data = array('Success' => true,
            'msg' => "Successfully de-activated user!");
        echo json_encode($return_data);

    } catch (Exception $e) {
        $return_data = array('Success' => false,
            'msg' => "An error occured unable to de-activate user!");
        echo json_encode($return_data);
    }

} else if (isset($_REQUEST['getUser'])) {

    try { 
        $user = new user($dbc, $user_id );  

    } catch (Exception $e) {
        $return_data = array('Success' => false,
            'msg' => "An error occured unable return user!");
        echo json_encode($return_data);
    } 

} else {

    try{
        $user = new user($dbc);
        echo json_encode($user->getUsers());
    } catch (Exception $e) {
        $return_data = array('Success' => false,
            'msg' => "An error occured unable return users!");
        echo json_encode($return_data);
    }
}