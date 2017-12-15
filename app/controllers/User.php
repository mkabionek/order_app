<?php
/**
 * Created by PhpStorm.
 * User: michalkabionek
 * Date: 15.12.2017
 * Time: 15:31
 */

class User extends Controller
{
    public function index(){

    }

    public function login(){
        $this->partial("header");
        $this->view('user/login');
        $this->partial("footer");
    }

    public function register(){
        $this->partial("header");
        $this->view('user/register');
        $this->partial("footer");
    }

    public function auth(){
        if (!isset($_POST) || empty($_POST)){
            $this->redirect("/");
            die();
        }else{
            $user = $this->model('User');
            if ($user->auth($_POST)){
                $this->redirect("/");
            }else {
                $this->redirect("/login");
            }
        }
    }
}