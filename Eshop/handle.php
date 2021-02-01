<?php
require ('vendor/autoload.php');
$request = json_decode(file_get_contents('php://input'),1);
print_r($request);

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
        $path = __DIR__ . '/src/img/';
        print_r($request['img_path']);
        $file = $request['img_path']['file'];
        move_uploaded_file($file, $path);
        $request['img_path'] = '/src/img/';
        $obj->addProduct($request);
    }
    catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}