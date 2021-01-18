<?php


namespace Eshop;


class Product
{
    protected $db = null;
    protected $requireFields = [
        'id',
        'name',
        'description',
        'price',
        'active',
        'img_path'
    ];
    public function __construct()
    {
        $this->db = new Db();
    }

    public function addProduct($fields)
    {
        $strQuery = 'INSERT INTO `products` ';
        //INSERT INTO `products` (`id`, `name`, `description`, `price`, `img_path`, `active`) VALUES (NULL, '1213', '123', '111', '123', '1');
        if (!isset($fields['id'])) {
            //$fields['id'] = '';
        }

        foreach ($fields as $k => &$field) {
            if (!in_array($k, $this->requireFields)) {
                unset($fields[$k]);
            }

            $field = "'" . $field . "'";
        }

        $fieldsKeys = implode(',', array_keys($fields));
        $fieldsValues = implode(',', $fields);

        $strQuery = "INSERT INTO `products` ({$fieldsKeys}) VALUES ({$fieldsValues});";
        $this->db->query($strQuery);


    }
}