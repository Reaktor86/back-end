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
    // добываем инфу о товарах

    $obj = new \Eshop\Product();
    //$obj->addProduct($fields);
    $products = $obj->getProducts();
    //$quantity = $obj->getTotalQuantity();
    //$shopAssort = $obj->getShopAssortment(1);

    // работа с корзиной юзера

    $user = 1;
    $obj = new \Eshop\Cart($user);
    //$obj->createCart();
    //$obj->add(14, 3);
    //$cartData = $obj->getCartData();

    // таблица со всеми заказами
    $orders = $obj->getAllOrders();
}
catch (Exception $e) {
    mail('admin@admin.ri', 'Ошибка на сайте', $e->getMessage());
    var_dump($e->getMessage());
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

<form class="form-add" enctype="multipart/form-data">
    <input type="text" name="Name" placeholder="название"><br>
    <input type="text" name="Description" placeholder="описание"><br>
    <input type="text" name="Price" placeholder="цена"><br>
    <input type="text" name="Active" placeholder="активный?"><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000">
    <input type="file" name="img_path" placeholder="загрузить изображение"><br>
    <button class="form-add__button">Добавить</button>
</form>

<table border="1">
    <thead>
    <tr>
        <? if (!$quantity): ?>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Активный</th>
        <th>Изображение</th>
        <th>Обновить</th>
        <th>Удалить</th>
        <th>В корзину</th>
        <? else: ?>
            <th>ID</th>
            <th>Название</th>
            <th>Общее кол-во</th>
        <? endif; ?>
    </tr>
    </thead>
    <tbody>
    <?
    if (!$quantity): ?>

        <? foreach ($products as $val): ?>
    <tr>
        <td><?= $val['id'] ?></td>
        <td><?= $val['name'] ?></td>
        <td><?= $val['description'] ?></td>
        <td><?= $val['price'] ?></td>
        <td><?= $val['active'] ?></td>
        <td><img src="<?= $val['img_path'] ?>"></td>
        <td>
            <button class="update" data-id="<?= $val['id'] ?>">Upd</button>
        </td>
        <td>
            <button class="delete" data-id="<?= $val['id'] ?>">X</button>
        </td>
        <td>
            <button class="add-to-cart" data-id="<?= $val['id'] ?>">Add</button>
        </td>
    <tr>
        <? endforeach; ?>

    <? else: ?>

        <? foreach ($quantity as $val): ?>
    <tr>
        <td><?= $val['id'] ?></td>
        <td><?= $val['name'] ?></td>
        <td><?= $val['total_quantity'] ?></td>
    <tr>
        <? endforeach; ?>

    <? endif; ?>

    </tbody>
</table>

<? if ($shopAssort): ?>
<br>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Кол-во в магазине</th>
    </tr>
    </thead>
    <tbody>

    <? foreach ($shopAssort as $val): ?>
    <tr>
        <td><?= $val['id'] ?></td>
        <td><?= $val['name'] ?></td>
        <td><?= $val['quantity'] ?></td>
    <tr>
        <? endforeach; ?>

    </tbody>
</table>
<? endif; ?>

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
<button class="cart-button">КОРЗИНА</button>

<p><b>Все заказы</b></p>

<table border="1">
    <thead>
    <tr>
        <th>Номер заказа</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Адрес</th>
        <th>Товары</th>
        <th>Стоимость</th>
        <th>Доставка</th>
        <th>Стоимость доставки</th>
        <th>Общая стоимость</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>

    <? foreach ($orders as $item): ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['surname'] ?></td>
            <td><?= $item['address'] ?></td>
            <td><ul>
                <?
                $objCart = $obj->getCartData($item['id']);
                $objCartArray = $objCart['products'];
                foreach ($objCartArray as $prods): ?>
                <li><?= $prods['name'] ?></li>
                <? endforeach; ?>
                </ul></td>
            <td><?= $objCart['total_price'] ?></td>
            <td><?= $item['ship_type'] ?></td>
            <td><?= $item['ship_cost'] ?></td>
            <td><?= $objCart['total_price'] + $item['ship_cost'] ?></td>
            <td><?= $item['status'] ?></td>
        </tr>
    <? endforeach; ?>

    </tbody>
</table>

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
    .cart-button {
        margin: 30px 0;
    }

</style>

<script src="scripts.js"></script>
