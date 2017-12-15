<?php
/**
 * Created by PhpStorm.
 * User: michalkabionek
 * Date: 15.12.2017
 * Time: 11:31
 */

class Home extends Controller {

    public function index($name = ''){
//        $user = $this->model('User');
//        $user->data = $name;

//        $result = $user->find($name);
        $this->view('home/index');
    }

}