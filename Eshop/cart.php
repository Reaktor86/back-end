<?php
require('vendor/autoload.php');

$objCart = new \Eshop\Cart(1);
$cartData = $objCart->getCartData();
//echo "<pre>"; print_r($cartData); echo "</pre>";
?>

<style>
    .confirm-block
    {
        display: none;
    }
</style>
<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Кол-во</th>
        <th>Цена</th>
        <th>Удалить</th>
    </tr>
    </thead>
    <tbody>

    <? foreach ($cartData['products'] as $item): ?>
        <tr data-recordId="<?=$item['rid']?>">
            <td><?= $item['name'] ?></td>
            <td>
                <button class="minus-quantity"><span>-</span></button>
                <span class="quantity-num"><?= $item['quantity'] ?></span>
                <button class="plus-quantity"><span>+</span></button>
            </td>
            <td><?=$item['price']?></td>
            <td><button class="delete-record">Удалить</button></td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>
<div style="font-size: 18px">
    Итоговая цена: <span class="total-data"><?=$cartData['total_price']?></span>
</div>
<br>
<button class="confirm-order">Оформить заказ</button>
<br><br>

<div class="confirm-block">
    <table border="1">
        <thead>
        <tr>
            <th>Товар</th>
            <th>Количество</th>
            <th>Цена</th>
        </tr>
        </thead>
        <tbody>

        <? foreach ($cartData['products'] as $item): ?>
            <tr data-recordId="<?=$item['rid']?>">
                <td><?= $item['name'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?=$item['price']?></td>
            </tr>
        <? endforeach; ?>

        </tbody>
    </table>
    <br>
    <div style="font-size: 18px">
        Итоговая цена: <span class="total-data"><?= $cartData['total_price'] ?></span>
    </div>
    <br>
    <form class="confirm-form">
        <input type="text" name="name" placeholder="Имя"><br>
        <input type="text" name="surname" placeholder="Фамилия"><br>
        <input type="text" name="address" placeholder="Адрес доставки"><br><br>
        <input type="checkbox" name="save"><span>Запомнить параметры доставки</span><br><br>
        <button class="confirm-button" type="submit">Подтвердить</button>
    </form>
</div>

<script src="cart.js"></script>
