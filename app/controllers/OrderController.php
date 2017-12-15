<?php
/**
 * Created by PhpStorm.
 * User: michalkabionek
 * Date: 15.12.2017
 * Time: 18:25
 */

class OrderController extends Controller {

    public function index(){
        $user = $this->model('User');
        if (!$user->is_logged_in()){
            $this->redirect("/");
        }else {
            $orderModel = $this->model('Order');
            $result = $orderModel->all($user->get_id());
            $this->partial("header");
            $this->view('order/index', ["orders" => $result]);
            $this->partial("footer");
        }
    }

    public function show($params=[]){
        if (!isset($params) || empty($params)){
            $this->redirect("/order");
            die();
        }
        $orderModel = $this->model('Order');
        $order = $orderModel->find_by_id($params);
        if ($order){
            $this->partial("header");
            $this->view('order/show', ["order" => $order]);
            $this->partial("footer");
        }else {
            $this->redirect('/');
        }
    }

    public function add(){
        $this->partial("header");
        $orderModel = $this->model('Order');
        $categories = $orderModel->get_all_categories();
        $types = $orderModel->get_all_types();

        $this->view('order/new', [
            "categories" => $categories,
            "types" => $types]
        );
        $this->partial("footer");
    }

    public function insert(){
        if (!isset($_POST) || empty($_POST)){
            $this->redirect("/");
            die();
        }else{
            $orderModel = $this->model('Order');
            if ($orderModel->insert($_POST)){
                $this->redirect("/");
            }else {
                $this->redirect("/order/add");
            }
        }
    }

}