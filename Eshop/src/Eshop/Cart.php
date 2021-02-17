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
        // узнать id корзины юзера
    {
        $query = "SELECT * FROM {$this->cartTable} WHERE `user_id` = {$this->userId} ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($query);
        $return = $result->fetch_all(MYSQLI_ASSOC);
        return current($return);
    }

    public function createCart()
        // создать корзину
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
        // добавить продукт в корзину - только запрос
    {
        $query = "INSERT INTO {$this->cartProductTable} (`product_id`, `quantity`, `cart_id`) VALUES ('{$productId}', '{$quantity}', '{$this->cartId}');";
        return $this->db->query($query);
    }

    public function add($productId, $quantity)
        // добавить продукт в корзину - полный алгоритм
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
        // узнать содержимое корзины
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
        // узнать кол-во определенного продукта из корзины
    {
        $query = "SELECT quantity FROM {$this->cartProductTable} WHERE id = {$productId}";

        $result = $this->db->query($query);
        $return = $result->fetch_all(MYSQLI_ASSOC);
        return $return[0]['quantity'];
    }

    public  function setCartProductQuantity($productId, $newQuantity)
        // установить кол-во определенного продукта из корзины
    {
        $query = "UPDATE {$this->cartProductTable} SET quantity = {$newQuantity} WHERE id = {$productId}";
        return $this->db->query($query);
    }

    public function deleteCartProduct($productId)
        // удалить продукт из корзины
    {
        $query = "DELETE FROM {$this->cartProductTable} WHERE id = {$productId}";

        return $this->db->query($query);
    }

    public function getAllOrders()
        // добыть информацию о каждом заказе всех юзеров (кроме инфы о продуктах в корзине)
    {
        $query = "SELECT cart.id, order_params.name, order_params.surname, order_params.address, shipping.type AS ship_type, shipping.cost AS ship_cost, order_status.type AS status
            FROM users
            INNER JOIN cart
            ON cart.user_id = users.id
            INNER JOIN order_params
            ON order_params.cart_id = cart.id
            INNER JOIN order_status
            ON order_status.id = order_params.status_id
            INNER JOIN shipping
            ON shipping.id = order_params.shipping_id  
            ORDER BY `cart`.`id` ASC;";

        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}