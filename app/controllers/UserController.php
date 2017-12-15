<?php
/**
 * Created by PhpStorm.
 * userController: michalkabionek
 * Date: 15.12.2017
 * Time: 15:31
 */

class UserController extends Controller
{
    public function index(){
        $user = $this->model('User');
        $result = $user->find_by_username('mkabionek');
        $this->partial("header");
        $this->view('user/index', ["user" => $result]);
        $this->partial("footer");
    }

    public function login(){
        $user = $this->model('User');
        if ($user->is_logged_in()){
            $this->redirect("/");
        }else {
            $this->partial("header");
            $this->view('user/login');
            $this->partial("footer");
        }

    }

    public function register(){
        $user = $this->model('User');
        if ($user->is_logged_in()){
            $this->redirect("/");
        }else{
            $this->partial("header");
            $this->view('user/register');
            $this->partial("footer");
        }
    }

    public function edit(){
        $user = $this->model('User');
        if (!$user->is_logged_in()){
            $this->redirect("/");
        }{
            $this->partial("header");
            $this->view('user/edit');
            $this->partial("footer");
        }
    }

    public function logout(){
        session_destroy();
        $this->redirect("/");
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
                $this->redirect("/user/login");
            }
        }
    }

    public function create() {
        if (!isset($_POST) || empty($_POST)){
            $this->redirect("/");
            die();
        }else {
            $user = $this->model('User');
            if ($user->insert($_POST)){
                $this->redirect("/");
            }else {
                $this->redirect("/user/register");
            }
        }
    }
}