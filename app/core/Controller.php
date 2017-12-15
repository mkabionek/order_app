<?php
/**
 * Created by PhpStorm.
 * User: michalkabionek
 * Date: 15.12.2017
 * Time: 11:28
 */


class Controller {

    public function model($model){
        require_once '../app/models/'.$model.'.php';
        return new $model();
    }

    public function view($view, $data = []){
        require_once '../app/views/'.$view.'.php';

    }

}