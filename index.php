<?php
    session_start();
    require_once 'app/init.php';

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    $app = new App;

?>