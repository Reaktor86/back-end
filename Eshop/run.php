<?php
require ('vendor/autoload.php');
$fields = [
    'name' => 'Opel',
    'description' => 'black',
    'price' => 4000,
    'active' => '0',
    'img_path' => '/img'
];
$obj = new \Eshop\Product();
//$obj->updateProduct(4,$fields);
//$obj->addProduct($fields);
//$obj->deleteProduct(3);
//$test = [1,2,4];
//$obj->deleteProducts($test);
//$obj->addProduct($fields);
$products = $obj->getProducts(['id', 'name'], ["active" => 0, "price" => 2000]);
echo "<pre>";
print_r($products);
echo "</pre>";

