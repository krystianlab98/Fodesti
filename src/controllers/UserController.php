<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';

session_start();

class UserController extends AppController {

    private static $haveSession;

    public function login()
    {
        $this->render('login');
    }

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

    public function getUserFromSession(): ?User
    {
        if ($this->isUserLogged()) {
            $userRepository = new UserRepository();
            return $this->mapUserFromDbToModel($userRepository->findByEmail($_SESSION['email']));
        }
        return null;
    }


    public function isUserLogged(): bool{
        if($_SESSION['email']) {
            return true;
        }
        return false;
    }

    public function mapUserFromDbToModel($userDb): User
    {
        return new User($userDb["id"],$userDb["email"],$userDb["password"],$userDb["name"],$userDb["surname"],$userDb["phone"],$userDb["address"]);
    }

}