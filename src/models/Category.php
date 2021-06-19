<?php


class Category
{
    private $id;
    private $title;
    private $imageName;



    public function __construct($title, $imageName, $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->imageName = $imageName;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title): void
    {
        $this->title = $title;
    }


    public function getImageName()
    {
        return $this->imageName;
    }


    public function setImageName($imageName): void
    {
        $this->imageName = $imageName;
    }



}