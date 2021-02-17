<?php


namespace Eshop;


class Shipping
{
    protected $shippingTable = 'shipping';
    protected $db = null;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getShipping()
        // взять всю ин-цию о вариантах доставки
    {
        $query = "SELECT * FROM {$this->shippingTable} WHERE 1";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCost($selectId)
        // взять цену за определенный тип доставки
    {
        $query = "SELECT cost FROM {$this->shippingTable} WHERE id = {$selectId}";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}