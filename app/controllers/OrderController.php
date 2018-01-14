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
            echo "<script src=\"/app/assets/js/show.js\"></script>";
        }else {
            $this->redirect('/');
        }
    }

    public function add(){
        $user = $this->model('User');
        if (!$user->is_logged_in()){
            $this->redirect("/");
        }

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

    public function take($params=[]){
        $user = $this->model('User');
        if (!$user->is_logged_in() || $user->get_type() != User::$DESIGNER_TYPE){
            $this->redirect("/");
        }
        $orderModel = $this->model('Order');
        $a = $orderModel->set_designer($params,$user->get_designer_id($_SESSION['user_id']));
        if ($a) {
            $this->redirect("/designer");
        }else{
            echo 'nie ok';
        }
    }

    public function accept(){
        $orderModel = $this->model('Order');
        if ($orderModel->accept($_POST)){
            echo 'OK';
        }else {
            echo "Error";
        }
    }

    public function edit($params = []){
        $user = $this->model('User');
        if (!$user->is_logged_in() || $user->get_type() != User::$DESIGNER_TYPE){
            $this->redirect("/");
        }
        $orderModel = $this->model('Order');

        $order = $orderModel->find_by_id($params);

        $this->partial("header");
        $this->view('order/edit', $order);
        $this->partial("footer");
    }

    public function update(){
        $user = $this->model('User');
        if (!$user->is_logged_in() || $user->get_type() != User::$DESIGNER_TYPE || !isset($_POST) || empty($_POST)){
            $this->redirect("/");
        }

        $orderModel = $this->model('Order');
        if ($orderModel->update($_POST)){
            $this->redirect("/designer/orders");
        }else {
            echo "Error";
        }
    }

    public function getnote(){
        $orderModel = $this->model('Order');
        if ($note = $orderModel->get_note($_POST['order_id'])){
            echo json_encode(array_slice($note, 2));
        }else {
            echo "Error";
        }
    }

    public function updatenote(){
        $orderModel = $this->model('Order');
        print_r($_POST);
        if ($orderModel->save_note($_POST)){
            echo 'OK';
        }else {
            echo "Error";
        }
    }

}