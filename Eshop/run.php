<?php
require ('vendor/autoload.php');
$fields = [
    'name' => 'Mercedes',
    'description' => 'white',
    'price' => 9000,
    'active' => '0',
    'img_path' => '/img'
];

try {
    $obj = new \Eshop\Product();
    //$obj->addProduct($fields);
    $products = $obj->getProducts();
}
catch (Exception $e) {
    mail('admin@admin.ri', 'Ошибка на сайте', $e->getMessage());
    var_dump($e->getMessage());
    var_dump($e->getTrace());
}

//$obj->updateProduct(2,$fields);
//$obj->addProduct($fields);
//$obj->deleteProduct(3);
//$test = [1,2,4];
//$obj->deleteProducts($test);
//$obj->addProduct($fields);
/*$products = $obj->getProducts(['id', 'name'], ["active" => 0, "price" => 2000]);
echo "<pre>";
print_r($products);
echo "</pre>";*/

?>

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Активный</th>
        <th>Обновить</th>
        <th>Удалить</th>
    </tr>
    </thead>
    <tbody>
    <?
    foreach ($products

    as $val): ?>
    <tr>
        <td><?= $val['id'] ?></td>
        <td><?= $val['name'] ?></td>
        <td><?= $val['description'] ?></td>
        <td><?= $val['price'] ?></td>
        <td><?= $val['active'] ?></td>
        <td>
            <button class="update" data-id="<?= $val['id'] ?>">Upd</button>
        </td>
        <td>
            <button class="delete" data-id="<?= $val['id'] ?>">X</button>
        </td>
    <tr>
        <? endforeach; ?>
    </tbody>
</table>

<div class="popup">
    <form class="popup__form">
        <input type="text" name="id">
        <input type="text" name="Name">
        <input type="text" name="Description">
        <input type="text" name="Price">
        <input type="text" name="Active">
        <button class="popup__button">Изменить</button>
    </form>
</div>

<style>

    .popup {
        margin-top: 20px;
        display: none;
    }
    .popup__form {
        width: 300px;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }
    .popup__form button {
        width: 75px;
    }
</style>

<script src="scripts.js"></script>