<?php
require ('vendor/autoload.php');
$request = json_decode(file_get_contents('php://input'),1);
var_dump($request);
$obj = new \Eshop\Product();
$obj->deleteProduct($request['id']);