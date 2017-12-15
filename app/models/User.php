<?php
/**
 * Created by PhpStorm.
 * userController: michalkabionek
 * Date: 15.12.2017
 * Time: 13:08
 */

class User extends Model
{
    public $name;

    public function __construct(){
        parent::__construct();
    }

    public function is_logged_in(){
        if(isset($_SESSION['user_id'])){
            return true;
        }
    }

    public function find_by_email($email){
        $query = "SELECT * FROM `user` WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function find_by_username($username){
        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function insert($data){
        $username = trim($data['username']);
        $email = trim($data['email']);

        if($this->find_by_username($username) || $this->find_by_email($email)){
            return false;
        }else {
            $type_id = 1;
            $password = trim($data['password']);
            $salt = sha1(openssl_random_pseudo_bytes(20));

            $query = "INSERT INTO user (`id`, `type_id`, `username`, `email`, `password`, `active`, `salt`, `created_at`) 
            VALUES (null, :type_id, :username, :email, :password, 0, :salt, CURRENT_DATE())";

            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":type_id", $type_id);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":salt", $salt);

//            $stmt->execute();
            return true;
        }


    }

}