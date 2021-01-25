<?php
require ('vendor/autoload.php');
$request = json_decode(file_get_contents('php://input'),1);

$obj = new \Eshop\Product();

if ($request['method'] == 'update')
{
    try {
        $obj->updateProduct($request['id'], $request);
    }
    catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
elseif ($request['method'] == 'delete')
{
    $obj->deleteProduct($request['id']);
}
elseif ($request['method'] == 'getProduct')
{
    $objData = $obj->getProducts(["*"],['id'=>$request['id']]);
    echo json_encode($objData);
}
elseif ($request['method'] == 'add')
{
    try {
        $obj->addProduct($request);
        $filename = $_FILES['uploadedFile']['name'];
        move_uploaded_file($filename, 'src/img');
        // закончил здесь - организовать считываение файла в product.php
    }
    catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}