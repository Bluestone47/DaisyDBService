<?php
/**
 * Created by PhpStorm.
 * User: xiandong
 * Date: 2019-03-26
 * Time: 11:31
 *
 * This code will create a new user in the database.
 *
 */
 
// get database connection
include_once '../config/DbConnect.php';
 
// instantiate operation object
include_once '../objects/UserOperation.php';

// get database connection
$database = new DbConnect();
$db = $database->getConnection();

// prepare operation object
$user = new UserOperation($db);
 
// set user property values
$_POST = json_decode(file_get_contents('php://input'), true);
$user->email = $_POST['email'];
$user->password = base64_encode($_POST['password']);
$user->center_id = $_POST['center_id'];
$user->dob = $_POST['dob'];
$user->create_time = date('Y-m-d H:i:s');
 
// create the user and return message
if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "user_id" => $user->user_id,
        "email" => $user->email,
        "center_id" => $user->center_id
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "email already exists!"
    );
}
print_r(json_encode($user_arr));
?>