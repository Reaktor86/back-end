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

    public function updateProduct($id, $fields)
    {
        $temp = [];
        foreach ($fields as $k => $value) {
            $string = "`" . $k . "`" . "=" . "'" . $value ."'";
            $temp[] = $string;
        }
        echo"<pre>";
        print_r($temp);
        echo"<pre>";
        $setString = implode(',',$temp);
        $updateStr = "UPDATE `products` SET {$setString} WHERE `id` = {$id}";
        print_r($updateStr);
        $this->db->query($updateStr);
    }

    public function deleteProduct($id)
    {
        //"DELETE FROM `products` WHERE `products`.`id` = 5"
        $str = "DELETE FROM `products` WHERE `products`.`id` = {$id}";
        echo"<pre>";
        print_r($str);
        echo"<pre>";
        $this->db->query($str);
    }
    public function deleteProducts($id)
    {
        foreach ($id as $x)
        {
            $this->deleteProduct($x);
        }
    }

    public function getProducts($select = ['*'], $filter = [])
    {
        $selectStr = implode(',', $select);
        $filterStr = '1';
        if (!empty($filter)) {
            $temp = [];
            foreach ($filter as $k => $value) {
                $string = "`" . $k . "`" . "=" . "'" . $value . "'";
                $temp[] = $string;
            }
            $filterStr = implode(' AND ', $temp);
        }

        $str = "SELECT {$selectStr} FROM `products` WHERE {$filterStr}";
        // SELECT * FROM `products` WHERE `price` = 2000 AND `active` = 0

        $result = $this->db->query($str);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}