<?php
/**
 * Created by PhpStorm.
 * User: xiandong
 * Date: 2019-03-26
 * Time: 11:31
 *
 * This code will help users to register and login.
 *
 */

class UserOperation{
 
    // database connection and table name
    private $conn;
    private $table_name = "Users";
 
    // object properties
    public $user_id;
    public $email;
    public $password;
    public $center_id;
    public $dob;
    public $create_time;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function signup(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    email=:email, password=:password, center_id=:center_id, dob=:dob, create_time=:create_time";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->center_id=htmlspecialchars(strip_tags($this->center_id));
        $this->dob=htmlspecialchars(strip_tags($this->dob));
        $this->create_time=htmlspecialchars(strip_tags($this->create_time));
    
        // bind values
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":center_id", $this->center_id);
        $stmt->bindParam(":dob", $this->dob);
        $stmt->bindParam(":create_time", $this->create_time);
    
        // execute query
        if($stmt->execute()){
            $this->user_id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
        
    }
    // login user
    function login(){
        // select all query
        $query = "SELECT
                    `user_id`, `email`, `password`, `center_id`, `dob`, `create_time`
                FROM
                    " . $this->table_name . " 
                WHERE
                    email='".$this->email."' AND password='".$this->password."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }

}