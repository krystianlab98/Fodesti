<?php

class User {
    private ?int $id;
    private $email;
    private $password;
    private $name;
    private $surname;
    private $phone;
    private $address;
    private $role;

    public function __construct(?int $id, $email, $password, $name, $surname, $phone, $address, $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->address = $address;
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email): void
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name): void
    {
        $this->name = $name;
    }


    public function getSurname()
    {
        return $this->surname;
    }


    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }


    public function getPhone()
    {
        return $this->phone;
    }


    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }


    public function getAddress()
    {
        return $this->address;
    }


    public function setAddress($address): void
    {
        $this->address = $address;
    }




}