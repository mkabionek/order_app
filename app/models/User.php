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

    public function auth($data){
        $email = trim($data['email']);
        $password = trim($data['password']);

        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() > 0){
            if(password_verify($password, $result['password'])){
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                return true;
            }else{
//                $this->errors[] = "Invalid email or password";
                return false;
            }
        }else {
//            $this->errors[] = "Invalid email or password";
            return false;
        }
    }

}