<?php
require('vendor/autoload.php');

$objCart = new \Eshop\Cart(1);
$cartData = $objCart->getCartData();
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
    <select name="shipping">
        <option>Самовывоз (бесплатно)</option>
        <option>Почтой России (+250р)</option>
        <option>СДЭК (+350р)</option>
    </select><br>
    <!--<input type="checkbox" name="save"><span>Запомнить параметры доставки</span><br><br>-->
    <br>
    <div style="font-size: 18px">
        Итог: <span class="total-data"><?= $cartData['total_price'] ?></span>
    </div><br>
    <button class="confirm-button" type="submit">Подтвердить</button>
</form>
<button class="cancel-button" type="submit">Отменить</button>

<script src="order.js"></script>