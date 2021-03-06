<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('login', 'UserController');
Router::post('logged', 'UserController');
Router::get("logout", 'UserController');
Router::get('register', 'UserController');
Router::post('createUser', 'UserController');
Router::post('addCategory', 'CategoryController');
Router::get('addCategoryView', 'CategoryController');
Router::get('categories', 'CategoryController');
Router::get('addDishView', 'DishController');
Router::post('addDish', 'DishController');
Router::get('dishes', 'DishController');
Router::get('dishesView', 'DishController');
Router::post("search", 'DishController');
Router::get("cart", 'OrderController');
Router::post('order','OrderController');
Router::get('orders','OrderController');
//Router::post("addDishToOrder","OrderController");

Router::run($path);