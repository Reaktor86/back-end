<?php


namespace Eshop;


class OrderParams
{
    protected $cartId = false;
    protected $db = null;
    protected $orderTable = 'order_params';

    public function __construct($cartId)
    {
        $this->cartId = $cartId;
        $this->db = new Db();
    }

    public function setOrderParams($name = 'test', $surname = 'test', $address = 'test', $shippingId = 1)
        // внести данные заказа
    {
        $query = "INSERT INTO {$this->orderTable} (`name`, `surname`, `address`, `shipping_id`, `status_id`, `cart_id`) 
        VALUES ('{$name}', '{$surname}', '{$address}', '{$shippingId}', 1, {$this->cartId});";
        return $this->db->query($query);
    }

    public function getOrderParams()
        // забрать данные заказа
    {
        $query = "SELECT * FROM {$this->orderTable} WHERE `cart_id` = {$this->cartId} ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($query);
        $return = $result->fetch_all(MYSQLI_ASSOC);
        return current($return);
    }

}