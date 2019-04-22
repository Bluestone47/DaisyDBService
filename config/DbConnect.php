<?php
/**
 * Created by PhpStorm.
 * User: xiandong
 * Date: 2019-03-26
 * Time: 11:31
 *
 * This code will create a database connection.
 *
 */

class DbConnect{

    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;

        require_once 'Config.php';
 
        try{
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>