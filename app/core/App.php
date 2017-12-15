<?php
/**
 * Created by PhpStorm.
 * userController: michalkabionek
 * Date: 15.12.2017
 * Time: 11:26
 */

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];


    public function __construct(){
        $url = $this->parseUrl();

        // find a controller
        if (file_exists('app/controllers/'.$url[0].'Controller.php')){
            $this->controller = $url[0].'Controller';
            unset($url[0]);
        }

        require_once 'app/controllers/'. $this->controller.'.php';

        $this->controller = new $this->controller;

        // find a method
        if (isset($url[1])){
            if (method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }else{ // default
//                $this->controller = 'HomeController';
//                require_once 'app/controllers/'. $this->controller.'.php';
//                $this->controller = new $this->controller;
//                $this->method ='index';
                $this->controller->redirect('/');
            }
        }

        // get params
        $this->params = $url? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);


    }

    public function parseUrl(){
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}