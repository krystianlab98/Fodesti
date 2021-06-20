<?php


class Dish
{
    private $id;
    private $name;
    private $imageName;
    private $description;
    private $price;

    public function __construct($name, $imageName, $description, $price, $id=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->imageName = $imageName;
        $this->description = $description;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name): void
    {
        $this->name = $name;
    }


    public function getImageName()
    {
        return $this->imageName;
    }


    public function setImageName($imageName): void
    {
        $this->imageName = $imageName;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description): void
    {
        $this->description = $description;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price): void
    {
        $this->price = $price;
    }




}