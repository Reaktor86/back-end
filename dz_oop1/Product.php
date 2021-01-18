<?php

$obj = new Product($_POST["name"], $_POST["price"]);
$obj->setProduct();

class Product
{
    protected $name = '';
    protected $price = '';

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getProduct()
    {
        return $this->name . ';'. $this->price;
    }

    public function setProduct($name, $price)
    {
        $this->name = $name;
        $this->price = $name;
    }
}