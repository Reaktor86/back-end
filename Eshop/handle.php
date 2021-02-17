<?php
require ('vendor/autoload.php');
$request = json_decode(file_get_contents('php://input'),1);

if (empty($request)) {
    $request = $_REQUEST;
    $request['img_path'] = $_FILES['file_img'];
}

$obj = new \Eshop\Product();
$objCart = new \Eshop\Cart(1);
$objShipping = new \Eshop\Shipping();

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
    $resultDeleteProduct = $objCart->deleteCartProduct($request['id']);
    $getCurrentCart = $objCart->getCartData();
    echo json_encode(['result' => $resultDeleteProduct, 'totalPrice' => $getCurrentCart['total_price']]);
}
elseif ($request['method'] == 'minusQuantityCartProduct') {

    $currentQuantity = $objCart->getCartProductQuantity($request['id']);
    if ($currentQuantity > 1) {
        $currentQuantity--;
        $objCart->setCartProductQuantity($request['id'], $currentQuantity);
        $getCurrentCart = $objCart->getCartData();
        echo json_encode(['quantity' => $currentQuantity, 'totalPrice' => $getCurrentCart['total_price']]);
    }
}
elseif ($request['method'] == 'plusQuantityCartProduct') {
    $currentQuantity = $objCart->getCartProductQuantity($request['id']);
    $currentQuantity++;
    $objCart->setCartProductQuantity($request['id'], $currentQuantity);
    $getCurrentCart = $objCart->getCartData();
    echo json_encode(['quantity' => $currentQuantity, 'totalPrice' => $getCurrentCart['total_price']]);
}
elseif ($request['method'] == 'addToCart')
{
    $objCart->add($request['id'], 1);
}
elseif ($request['method'] == 'confirmOrder')
{
    $cartId = $objCart->getUserCart();
    $order = new \Eshop\OrderParams($cartId['id']);
    $order->setOrderParams($request['name'], $request['surname'], $request['address'], $request['shipping_id']);
    $objCart->createCart();
}
elseif ($request['method'] == 'getOrderParams')
{
    $cartId = $objCart->getUserCart();
    $order = new \Eshop\OrderParams($cartId['id']);
    $result = $order->getOrderParams();
    echo json_encode(['name' => $result['name'], 'surname' => $result['surname'], 'address' => $result['address'], 'shipping' => $result['shipping'], 'status' => $result['status']]);
}
elseif ($request['method'] == 'getShippingCost')
{
    $cost = $objShipping->getCost($request['shipping_id']);
    $getCurrentCart = $objCart->getCartData();
    echo json_encode(['totalPrice' => $getCurrentCart['total_price'], 'cost' => current($cost)['cost']]);
}
