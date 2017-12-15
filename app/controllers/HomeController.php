<?php
/**
 * Created by PhpStorm.
 * userController: michalkabionek
 * Date: 15.12.2017
 * Time: 11:31
 */

class HomeController extends Controller {

    public function index($name = ''){
//        $user = $this->model('userController');
//        $user->data = $name;

//        $result = $user->find($name);

        $this->partial("header");
        $this->view('home/index');
        $this->partial("footer");
    }

    public function help(){
        $this->partial("header");
        echo 'help';
        $this->partial("footer");
    }

}