<?php
/**
 * Created by PhpStorm.
 * User: michalkabionek
 * Date: 15.12.2017
 * Time: 13:08
 */

class User extends Model
{
    public $name;

    public function __construct(){
        parent::__construct();
    }

    public function find($email){
        $query = "SELECT * FROM `user` WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}