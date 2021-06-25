<?php


class Dish
{
    private int $id;
    private $name;
    private $imageName;
    private $description;
    private $price;
    private $categoriesId;


    public function __construct($name, $imageName, $description, $price, int $id=null, $categoriesId=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->imageName = $imageName;
        $this->description = $description;
        $this->price = $price;
        $this->categoriesId = $categoriesId;
    }


    public function getCategoriesId()
    {
        return $this->categoriesId;
    }

    public function setCategoriesId($categoriesId): void
    {
        $this->categoriesId = $categoriesId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setId(int $id): void
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