<?php
/**
 * Created by PhpStorm.
 * userController: michalkabionek
 * Date: 15.12.2017
 * Time: 11:31
 */

class HomeController extends Controller {

    public function index($name = ''){
        $user = $this->model('User');

        $this->partial("header");
        if ($user->is_logged_in()){
            if($user->get_type() == User::$CLIENT_TYPE){
                $this->view('home/client');
            }else if($user->get_type() == User::$DESIGNER_TYPE){
                $this->view('home/designer');
            }

        }else {
            $this->view('static/index');
        }

        $this->partial("footer");
    }

}