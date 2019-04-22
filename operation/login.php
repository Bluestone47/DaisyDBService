<?php
/**
 * Created by PhpStorm.
 * User: xiandong
 * Date: 2019-03-26
 * Time: 11:31
 *
 * This code will check the username and password and let users login.
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

// set ID property of user to be edited
$user->email = isset($_GET['email']) ? $_GET['email'] : die();
$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());
// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "user_id" => $row['user_id'],
        "email" => $row['email'],
        "center_id" => $row['center_id']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid email or Password!",
    );
}
// make it json format
print_r(json_encode($user_arr));
?>