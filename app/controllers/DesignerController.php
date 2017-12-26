<?php
/**
 * Created by PhpStorm.
 * User: michalkabionek
 * Date: 16.12.2017
 * Time: 00:56
 */

class DesignerController extends Controller {

    public function index(){
        $user = $this->model('User');
        if (!$user->is_logged_in() || $user->get_type() != User::$DESIGNER_TYPE){
            $this->redirect("/");
        }
        $orderModel = $this->model('Order');
        $result = $orderModel->find_all_by_designer();


        $this->partial("header");
        $this->view('designer/index', ["orders" => $result]);
//        print_r($result);
        $this->partial("footer");
    }

  



}