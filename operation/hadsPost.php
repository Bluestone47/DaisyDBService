<?php
/**
 * Created by PhpStorm.
 * User: xiandong
 * Date: 2019-03-26
 * Time: 11:31
 *
 * This code will insert the HADS answers to database.
 *
 */

//creating response array
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values
    $_POST = json_decode(file_get_contents('php://input'), true);
    $ensat_id = $_POST['ensat_id'];
    $center_id = $_POST['center_id'];
    $qhads_1 = $_POST['qhads_1'];
    $qhads_2 = $_POST['qhads_2'];
    $qhads_3 = $_POST['qhads_3'];
    $qhads_4 = $_POST['qhads_4'];
    $qhads_5 = $_POST['qhads_5'];
    $qhads_6 = $_POST['qhads_6'];
    $qhads_7 = $_POST['qhads_7'];
    $qhads_8 = $_POST['qhads_8'];
    $qhads_9 = $_POST['qhads_9'];
    $qhads_10 = $_POST['qhads_10'];
    $qhads_11 = $_POST['qhads_11'];
    $qhads_12 = $_POST['qhads_12'];
    $qhads_13 = $_POST['qhads_13'];
    $qhads_14 = $_POST['qhads_14'];

    //including the operation file
    require_once '../objects/HadsOperation.php';

    // prepare operation object
    $db = new HadsOperation();

    //inserting values
    if($db->uploadHads($ensat_id, $center_id, $qhads_1, $qhads_2, $qhads_3, $qhads_4, $qhads_5, $qhads_6, $qhads_7, $qhads_8, $qhads_9, $qhads_10, $qhads_11, $qhads_12, $qhads_13, $qhads_14)){
        $response['error']=false;
        $response['message']='HADS uploaded successfully';
    }else{

        $response['error']=true;
        $response['message']='Could not upload result';
    }

}else{
    $response['error']=true;
    $response['message']='You are not authorized';
}
echo json_encode($response);