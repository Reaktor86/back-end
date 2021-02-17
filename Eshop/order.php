<?php
require('vendor/autoload.php');

$objCart = new \Eshop\Cart(1);
$cartData = $objCart->getCartData();
$objShipping = new \Eshop\Shipping();
$shippingData = $objShipping->getShipping();


//echo "<pre>"; print_r($cartData); echo "</pre>";
?>

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
        <tr data-recordId="<?= $item['rid'] ?>">
            <td><?= $item['name'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><?= $item['price'] ?></td>
        </tr>
    <? endforeach; ?>

    </tbody>
</table>

<br>
<form class="confirm-form">
    <input type="text" name="name" placeholder="Имя"><br>
    <input type="text" name="surname" placeholder="Фамилия"><br>
    <input type="text" name="address" placeholder="Адрес доставки"><br>
    <select name="shipping" class="shipping">

        <? foreach ($shippingData as $val) : ?>
            <option value="<?=$val['id']?>">
                <?=$val['type']?> (
                <? if ($val['cost'] == 0) : ?>
                    бесплатно
                <? else : ?>
                +<?=$val['cost']?>р
                <? endif; ?>
                )
            </option>
        <? endforeach; ?>

    </select><br>
    <!--<input type="checkbox" name="save"><span>Запомнить параметры доставки</span><br><br>-->
    <br>
    <div class="total-price">

        Итог: <span class="total-data"><?= $cartData['total_price'] ?></span>
    </div><br>
    <? if ($cartData['total_price'] != 0) : ?>
        <button class="confirm-button" type="submit">Подтвердить</button>
    <? endif; ?>

</form>
<button class="cancel-button" type="submit">Отменить</button>

<style>
    .total-price {
        font-size: 18px;
    }

</style>

<script src="order.js"></script>