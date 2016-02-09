<?php
require "../include/db.php";
// require "../models/user_model.php";
require_once __DIR__.'/../vendor/autoload.php';
use Models\User;

/**
 * This controller will be hit via HTTP requests and return jSON to the view. 
 * Note when using post/put we need to grab the input stream & assign to a variable. 
 */

if (isset($_REQUEST['add'])) {
    
    try {
        $postdata = file_get_contents("php://input");
        $data     = json_decode($postdata, true);
        $user     = new user($dbc); 
        $user->setProperties($data);
        $user->addUser();

        $returnData = array(
            'Success' => true,
            'msg'     => "Successfully added new user!"
        );
        echo json_encode($returnData); 

    } catch (Exception $e) {
        //return error msg to view. 
        $returnData = array(
            'Success' => false,
            'msg'     => "An error occured unable to add new user!"
        );
        http_response_code(500);
        echo json_encode($returnData);     
    }

} else if (isset($_REQUEST['update'])) {
    
    try {
        $putdata = file_get_contents("php://input");
        $data    = json_decode($putdata, true);
        $user    = new user($dbc);
        $user->setProperties($data);
        $user->updateUser();

        $returnData = array(
            'Success' => true,
            'msg'     => "Successfully updated user!"
        );
        echo json_encode($returnData);

    } catch (Exception $e) {
        $returnData = array(
            'Success' => false,
            'msg'     => "An error occured unable to update user!"
        );
        http_response_code(500);
        echo json_encode($returnData);
    }

} else if (isset($_REQUEST['setInactive'])) {
    
    try { 
        $putdata = file_get_contents("php://input");
        $data    = json_decode($putdata, true);
        $user_id = $data;
        $user    = new user($dbc, $user_id);
        $user->setInactive();

        $returnData = array(
            'Success' => true,
            'msg'     => "Successfully de-activated user!"
        );
        echo json_encode($returnData);

    } catch (Exception $e) {
        $returnData = array(
            'Success' => false,
            'msg'     => "An error occured unable to de-activate user!"
        );
        http_response_code(500);
        echo json_encode($returnData);
    }

} else if (isset($_REQUEST['getUser'])) {

    try { 
        $user = new user($dbc, $user_id );  

    } catch (Exception $e) {
        $returnData = array(
            'Success' => false,
            'msg'     => "An error occured unable return user!"
        );
        http_response_code(500);
        echo json_encode($returnData);
    } 

} else {

    try{
        $user = new user($dbc);
        echo json_encode($user->getUsers());
    } catch (Exception $e) {
        $returnData = array(
            'Success' => false,
            'msg'     => "An error occured unable return users!"
        );
        http_response_code(500);
        echo json_encode($returnData);
    }
}