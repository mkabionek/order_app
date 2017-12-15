<?php
/**
 * Created by PhpStorm.
 * userController: michalkabionek
 * Date: 15.12.2017
 * Time: 11:28
 */


class Controller {

    public function model($model){
        require_once 'app/models/'.$model.'.php';
        return new $model();
    }

    public function view($view, $data = []){
        require_once 'app/views/'.$view.'.php';
    }

    public function partial($part){
        require_once 'app/views/partials/'.$part.'.php';
    }

    public function redirect($url){
        if (headers_sent()){

        }else {
            header("location: ".$url);
        }
    }

}