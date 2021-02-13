<?php


namespace Eshop;


class Cart
{
    protected $cartTable = 'cart';
    protected $cartProductTable = 'products_in_cart';
    protected $db = null;
    protected $userId = false;
    protected $cartId = false;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->db = new Db();
    }

    public function getUserCart()
    {
        $query = "SELECT * FROM {$this->cartTable} WHERE `user_id` = {$this->userId} ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($query);
        $return = $result->fetch_all(MYSQLI_ASSOC);
        return current($return);
    }

    public function createCart()
    {
        $query = "INSERT INTO {$this->cartTable} (`user_id`) VALUES ('{$this->userId}')";
        $exec = $this->db->query($query);

        if ($exec) {
            return $this->db->getDb()->insert_id;
        } else {
            throw new \Exception('Не удалось создать корзину!');
        }
    }

    public function addProductToCart($productId, $quantity)
    {
        $query = "INSERT INTO {$this->cartProductTable} (`product_id`, `quantity`, `cart_id`) VALUES ('{$productId}', '{$quantity}', '{$this->cartId}')";
        $result = $this->db->query($query);
        return $result;
    }

    public function add($productId, $quantity)
    {
        try {
            $checkUserCart = $this->getUserCart();

            if ($checkUserCart === false) {
                $this->cartId = $this->createCart();
            }
            else {
                $this->cartId = $checkUserCart['id'];
            }

            $this->addProductToCart($productId, $quantity);

        } catch (\Exception $e) {
            throw new \Exception('Не удалось добавить продукт в корзину!');
        }
    }

    public function getCartData()
    {
        $userCart = $this->getUserCart();
        $userCartId = $userCart['id'];

        $query = "SELECT *, products_in_cart.id as rid FROM {$this->cartProductTable}
        INNER JOIN products ON products.id = products_in_cart.product_id
        WHERE products_in_cart.cart_id = {$userCartId}";

        $exec = $this->db->query($query);

        $cartProducts = $exec->fetch_all(MYSQLI_ASSOC);
        $result = [
            'products' => $cartProducts,
            'total_price' => 0
        ];

        foreach ($cartProducts as $item) {
            $result['total_price'] += $item['price'] * $item['quantity'];
        }

        return $result;
    }

    public function getCartProductQuantity($productId)
    {
        $query = "SELECT quantity FROM {$this->cartProductTable} WHERE id = {$productId}";

        $result = $this->db->query($query);
        $return = $result->fetch_all(MYSQLI_ASSOC);
        return $return[0]['quantity'];
    }

    public  function setCartProductQuantity($productId, $newQuantity)
    {
        $query = "UPDATE {$this->cartProductTable} SET quantity = {$newQuantity} WHERE id = {$productId}";
        return $this->db->query($query);
    }

    public function deleteCartProduct($productId)
    {
        $query = "DELETE FROM {$this->cartProductTable} WHERE id = {$productId}";

        return $this->db->query($query);
    }

}