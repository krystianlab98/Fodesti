<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public  function getUser(string $email): ?User {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.users as u INNER JOIN public.user_details as ud ON u.id_user_details = ud.id WHERE u.email = :email 
        ');
        $statement->bindParam(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if($user == false) {
            return null;
        }
        return new User($user["id_user"], $user["email"], $user["password"], $user["name"], $user["surname"], $user["phone"], $user["address"]);
    }


    /**
     * @throws Exception
     */
    public function addUser(User $user){
        try {
           $this->database->connect()->beginTransaction();
           $statement = $this->database->connect()->prepare('
                INSERT INTO public.user_details (name, surname, phone, address) VALUES (?,?,?,?)
            ');
            $statement->execute([
                $user->getName(),
                $user->getSurname(),
                $user->getPhone(),
                $user->getAddress()
            ]);
            $statement = $this->database->connect()->prepare('
                INSERT INTO public.users (email, password, enabled, created_at, id_user_details, id_user_role)
                VALUES (?, ?, ?, ?, ?, ?)
                ');
            $userRoleId = 1;
            $statement->execute([
                $user->getEmail(),
                $user->getPassword(),
                true,
                date("Y-m-d"),
                $this->getUserDetailsId($user),
                $userRoleId
            ]);
            $this->database->connect()->inTransaction();
        } catch (PDOException $exception) {
            $this->database->connect()->rollBack();
            //var_dump($exception->getMessage());
            throw new Exception("transaction error insert user");
        }
    }

    private function getUserDetailsId(User $user)
    {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.user_details WHERE name = :name AND surname = :surname AND phone = :phone AND address = :address
        ');
        $name = $user->getName();
        $surname = $user->getSurname();
        $phone = $user->getPhone();
        $address = $user->getAddress();

        $statement->bindParam(':name', $name);
        $statement->bindParam(':surname', $surname);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':address', $address);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        return $data['id'];
    }






}