<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('login', 'DefaultController');
Router::post('logged', 'LoginController');
Router::get("logout", 'LoginController');
Router::get('register', 'LoginController');
Router::post('createUser', 'LoginController');

Router::run($path);