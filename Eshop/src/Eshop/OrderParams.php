<?php


namespace Eshop;


class OrderParams
{
    protected $userId = false;
    protected $db = null;
    protected $orderTable = 'order_params';

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->db = new Db();
    }

    public function setOrderParams($name = 'test', $surname = 'test', $address = 'test')
        // внести данные юзера
    {
        echo 'запустился setOrderParams';
        $query = "INSERT INTO {$this->orderTable} (`name`, `surname`, `address`, `user_id`) VALUES ('{$name}', '{$surname}', '{$address}', '{$this->userId}');";
        return $this->db->query($query);
    }

    public function getOrderParams()
        // узнать данные юзера
    {
        $query = "SELECT * FROM {$this->orderTable} WHERE `user_id` = {$this->userId} ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($query);
        $return = $result->fetch_all(MYSQLI_ASSOC);
        return current($return);
    }

}