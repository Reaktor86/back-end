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
    protected function clearNotRequire($data)
    {
        foreach ($data as $k => $item) {
            if (!in_array($k, $this->requireFields)) {
                unset($data[$k]);
            }
        }

        return $data;
    }

    public function addProduct($fields)
    {
        //INSERT INTO `products` (`id`, `name`, `description`, `price`, `img_path`, `active`) VALUES (NULL, '1213', '123', '111', '123', '1');

        if (empty($fields) || !is_array($fields)) {
            throw new \Exception('Передали неверные данные');
        }

        // обработка файла

        $nameArr = explode('.', $fields['img_path']['name']);
        $ext = strtolower(end($nameArr));
        $extensions = ['png', 'jpg', 'jpeg'];

        var_dump($fields['img_path']);

        if (in_array($ext, $extensions)) {
            $name = md5('sold23' . time()) . '.' . $ext;
            $newPath = $_SERVER['DOCUMENT_ROOT'] . '/Eshop/src/img/' . $name;
            $check = move_uploaded_file($fields['img_path']['tmp_name'], $newPath);
            $fields['img_path'] = $newPath;
        } else {
            echo 'неправильный формат картинки';
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
        return $fields;
    }

    public function updateProduct($id, $fields)
    {
        $temp = [];
        $fields = $this->clearNotRequire($fields);
        unset($fields['id']);
        foreach ($fields as $k => $value) {
            if (!in_array($k, $this->requireFields)) {
                unset($fields[$k]);
            }
            $string = "`" . $k . "`" . "=" . "'" . $value ."'";
            $temp[] = $string;
        }

        $setString = implode(',',$temp);
        $updateStr = "UPDATE `products` SET {$setString} WHERE `id` = {$id}";
        $result = $this->db->query($updateStr);
        var_dump($updateStr);

        if (!$result) {
            throw new \Exception('Проблема с обновлением.');
        }
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

    public function getQuantity()
    {
        $str = 'SELECT products.id, products.name, SUM(products_quantity.quantity) AS total_quantity
            FROM products
            INNER JOIN products_quantity
            ON products.id = products_quantity.product_id
            GROUP BY products.id';
        $result = $this->db->query($str);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShopAssortment($shopId)
    {
        $str = 'SELECT products.id, products.name, products_quantity.quantity
            FROM products
            LEFT JOIN products_quantity
            ON products.id = products_quantity.product_id
            WHERE products_quantity.store_id = ' . $shopId;
        $result = $this->db->query($str);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}