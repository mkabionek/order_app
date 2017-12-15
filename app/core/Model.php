<?php
/**
 * Created by PhpStorm.
 * User: michalkabionek
 * Date: 15.12.2017
 * Time: 14:17
 */

class Model {
    private $host = "localhost:3306";
    private $db_name = "pai_project";
    private $username = "pai";
    private $password = "zaq1@WSX";

    protected $db;

    public function __construct() {
        try{
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password, $opt);
        }catch(PDOException $e){
            print "Connection error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}