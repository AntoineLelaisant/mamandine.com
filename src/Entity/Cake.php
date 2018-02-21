<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class Cake
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $image;
    private $categories;
    private $createdAt;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->createdAt = new DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(string $price)
    {
        $this->price = $price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function addCategory(Category $category)
    {
        $this->categories->add($category);
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function prepare()
    {
        // Let's emulate it takes a long time to create a cake
        sleep(1);
    }
}
