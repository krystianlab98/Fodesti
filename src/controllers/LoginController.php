<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';

session_start();

class LoginController extends AppController {

    private static $haveSession;


    public function logged()
    {

        $userRepository = new UserRepository();


        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

//        return $this->render("index");

        $_SESSION['email'] = $email;
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");

    }

    public function logout()
    {
        session_unset();
        session_destroy();

        return $this->render("index");
    }


    public function register(){
        $this->render('register');
    }

    /**
     * @throws Exception
     */
    public function createUser(){
        $userRepository = new UserRepository();
        if (!$this->isPost()) {
            return $this->render('register');
        }
        $email = $_POST['email'];

        if($this->isEmailUnique($email)){
            $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $user = new User(null, $email, $password, $name, $surname, $phone, $address);
            //var_dump($user);
            $userRepository->addUser($user);
            return $this->render("login");
        } else {
            return $this->render("register", ['messages' => ['Email is taken !']]);
        }

    }
    public function isEmailUnique($email): bool
    {
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);

        if($user){
            return false;
        }
        return true;
    }

}