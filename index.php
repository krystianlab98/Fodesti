<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('login', 'DefaultController');
Router::post('logged', 'UserController');
Router::get("logout", 'UserController');
Router::get('register', 'UserController');
Router::post('createUser', 'UserController');
Router::post('addCategory', 'CategoryController');
Router::get('addCategoryView', 'CategoryController');
Router::get('categories', 'CategoryController');

Router::run($path);