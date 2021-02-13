<?php
require('vendor/autoload.php');

$objCart = new \Eshop\Cart(1);
$cartData = $objCart->getCartData();
//echo "<pre>"; print_r($cartData); echo "</pre>";
?>

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

<script>
    let deleteButtons = document.querySelectorAll('.delete-record');
    deleteButtons.forEach(function (elemButton) {
        elemButton.addEventListener('click', function (e) {
            let parentTr = this.closest('tr');
            let recordId = parentTr.dataset.recordid;
            console.log(recordId);
            let params = {
                id: recordId,
                method: 'deleteCartProduct'
            };
            let response = fetch('/Eshop/handle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(params)
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    console.log(data)
                    document.querySelector('.total-data').innerHTML = data.totalPrice;
                    parentTr.remove();
                });

        });
    });

    let minusButtons = document.querySelectorAll('.minus-quantity');
    minusButtons.forEach(function (elemButton) {
        elemButton.addEventListener('click', function (e) {
            let parentTr = this.closest('tr');
            let recordId = parentTr.dataset.recordid;
            console.log(recordId);
            let params = {
                id: recordId,
                method: 'minusQuantityCartProduct'
            };
            let response = fetch('/Eshop/handle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(params)
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    console.log(data)
                    parentTr.querySelector('.quantity-num').innerHTML = data.quantity;
                    document.querySelector('.total-data').innerHTML = data.totalPrice;
                });

        });
    });

    let plusButtons = document.querySelectorAll('.plus-quantity');
    plusButtons.forEach(function (elemButton) {
        elemButton.addEventListener('click', function (e) {
            let parentTr = this.closest('tr');
            let recordId = parentTr.dataset.recordid;
            console.log(recordId);
            let params = {
                id: recordId,
                method: 'plusQuantityCartProduct'
            };
            let response = fetch('/Eshop/handle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(params)
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    console.log(data)
                    parentTr.querySelector('.quantity-num').innerHTML = data.quantity;
                    document.querySelector('.total-data').innerHTML = data.totalPrice;
                });

        });
    });

</script>
