<?php
/**
 * Created by PhpStorm.
 * User: xiandong
 * Date: 2019-03-26
 * Time: 11:30
 *
 * This file will upload HADS answers to the database.
 *
 */

class HadsOperation{
    private $conn;

    //Constructor
    function __construct()
    {
        require_once '../config/Config.php';
        require_once '../config/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->getConnection();
    }

    //Function to create a new user
    public function uploadHads($ensat_id, $center_id, $qhads_1, $qhads_2, $qhads_3, $qhads_4, $qhads_5, $qhads_6, $qhads_7, $qhads_8, $qhads_9, $qhads_10, $qhads_11, $qhads_12, $qhads_13, $qhads_14)
    {
        $data = array($ensat_id, $center_id, $qhads_1, $qhads_2, $qhads_3, $qhads_4, $qhads_5, $qhads_6, $qhads_7, $qhads_8, $qhads_9, $qhads_10, $qhads_11, $qhads_12, $qhads_13, $qhads_14);
        $stmt = $this->conn->prepare("INSERT INTO Questionnaire_HADS(ensat_id, center_id, qhads_1, qhads_2, qhads_3, qhads_4, qhads_5, qhads_6, qhads_7, qhads_8, qhads_9, qhads_10, qhads_11, qhads_12, qhads_13, qhads_14) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        # $stmt->bind_param("ssssssssssssssss", $ensat_id, $center_id, $qhads_1, $qhads_2, $qhads_3, $qhads_4, $qhads_5, $qhads_6, $qhads_7, $qhads_8, $qhads_9, $qhads_10, $qhads_11, $qhads_12, $qhads_13, $qhads_14);
        $result = $stmt->execute($data);
        # $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}