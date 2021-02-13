<?php
require ('vendor/autoload.php');
$request = json_decode(file_get_contents('php://input'),1);

if (empty($request)) {
    $request = $_REQUEST;
    $request['img_path'] = $_FILES['file_img'];
}

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
    }
    catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
elseif ($request['method'] == 'deleteCartProduct') {
    $objCart = new \Eshop\Cart(1);
    $resultDeleteProduct = $objCart->deleteCartProduct($request['id']);
    $getCurrentCart = $objCart->getCartData();
    echo json_encode(['result' => $resultDeleteProduct, 'totalPrice' => $getCurrentCart['total_price']]);
}
elseif ($request['method'] == 'minusQuantityCartProduct') {
    $objCart = new \Eshop\Cart(1);
    $currentQuantity = $objCart->getCartProductQuantity($request['id']);
    if ($currentQuantity > 1) {
        $currentQuantity--;
        $objCart->setCartProductQuantity($request['id'], $currentQuantity);
        $getCurrentCart = $objCart->getCartData();
        echo json_encode(['quantity' => $currentQuantity, 'totalPrice' => $getCurrentCart['total_price']]);
    }
}
elseif ($request['method'] == 'plusQuantityCartProduct') {
    $objCart = new \Eshop\Cart(1);
    $currentQuantity = $objCart->getCartProductQuantity($request['id']);
    $currentQuantity++;
    $objCart->setCartProductQuantity($request['id'], $currentQuantity);
    $getCurrentCart = $objCart->getCartData();
    echo json_encode(['quantity' => $currentQuantity, 'totalPrice' => $getCurrentCart['total_price']]);
}
