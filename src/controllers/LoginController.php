<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';

class LoginController extends AppController {

    public function logged()
    {
        $user = new User('jsnow@pk.edu.pl', 'admin', 'Johnny', 'Snow');

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

//        return $this->render("index");

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");

    }
}